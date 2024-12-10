import './style.css';
import AgoraRTC from "agora-rtc-sdk-ng";
import appid from './appId.js';

const token = null;
const rtcUid = Math.floor(Math.random() * 2032);

let roomId = "main";
let micMuted = true;
let userName = "";
let selectedAvatar = ""; // Track the selected avatar

let audioTracks = {
  localAudioTrack: null,
  remoteAudioTracks: {},
};

let rtcClient;
let userNames = {};
let userAvatars = {}; // Track all avatars with their UID

const initRtc = async () => {
  rtcClient = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

  rtcClient.on('user-joined', handleUserJoined);
  rtcClient.on("user-published", handleUserPublished);
  rtcClient.on("user-left", handleUserLeft);

  initVolumeIndicator();

  audioTracks.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
  audioTracks.localAudioTrack.setMuted(micMuted);

  await rtcClient.join(appid, roomId, token, rtcUid);

  // Send local user's name and avatar
  userNames[rtcUid] = userName;
  userAvatars[rtcUid] = selectedAvatar;

  document.getElementById('members').insertAdjacentHTML('beforeend', `
    <div class="speaker user-rtc-${rtcUid}" id="${rtcUid}">
      <img src="${selectedAvatar}" class="avatar-small" alt="Avatar">
      <p>${userName}</p>
    </div>
  `);

  await rtcClient.publish(audioTracks.localAudioTrack);
}

const handleUserJoined = async (user) => {
  console.log('USER joined:', user);

  // Send avatar to other users by updating user data in `userAvatars`
  rtcClient.sendMetadata({ userName, selectedAvatar }); 

  userNames[user.uid] = user.name || `User ${user.uid}`;
  userAvatars[user.uid] = user.avatar || 'avatar/default.png'; // Default avatar if not set

  document.getElementById('members').insertAdjacentHTML('beforeend', `
    <div class="speaker user-rtc-${user.uid}" id="${user.uid}">
      <img src="${userAvatars[user.uid]}" class="avatar-small" alt="Avatar" style="color=white">
      <p>${userNames[user.uid]}</p>
    </div>
  `);
}

const handleUserPublished = async (user, mediaType) => {
  await rtcClient.subscribe(user, mediaType);

  if (mediaType === "audio") {
    audioTracks.remoteAudioTracks[user.uid] = user.audioTrack;
    user.audioTrack.play();
  }

  // Display the avatar of the published user
  document.getElementById(user.uid).querySelector('.avatar-small').src = userAvatars[user.uid];
}

const handleUserLeft = async (user) => {
  delete audioTracks.remoteAudioTracks[user.uid];
  document.getElementById(user.uid).remove();
}

const initVolumeIndicator = async () => {
  AgoraRTC.setParameter('AUDIO_VOLUME_INDICATION_INTERVAL', 200);
  rtcClient.enableAudioVolumeIndicator();

  rtcClient.on("volume-indicator", volumes => {
    volumes.forEach(volume => {
      try {
        let item = document.getElementsByClassName(`user-rtc-${volume.uid}`)[0];
        item.style.borderColor = volume.level >= 50 ? '#00ff00' : '#fff';
      } catch (error) {
        console.error(error);
      }
    });
  });
}

const toggleMic = async (e) => {
  micMuted = !micMuted;
  e.target.src = micMuted ? 'icons/mic-off.svg' : 'icons/mic.svg';
  e.target.style.backgroundColor = micMuted ? 'indianred' : 'ivory';
  audioTracks.localAudioTrack.setMuted(micMuted);
}

document.getElementById('mic-icon').addEventListener('click', toggleMic);

let lobbyForm = document.getElementById('form');

const enterRoom = async (e) => {
  e.preventDefault();

  userName = document.getElementById('username-input').value || `User ${rtcUid}`;
  initRtc();

  lobbyForm.style.display = 'none';
  document.getElementById('room-header').style.display = "flex";
}

const leaveRoom = async () => {
  audioTracks.localAudioTrack.stop();
  audioTracks.localAudioTrack.close();
  rtcClient.unpublish();
  rtcClient.leave();

  document.getElementById('form').style.display = 'block';
  document.getElementById('room-header').style.display = 'none';
  document.getElementById('members').innerHTML = '';
}

lobbyForm.addEventListener('submit', enterRoom);
document.getElementById('leave-icon').addEventListener('click', leaveRoom);

// Handle avatar selection
window.selectAvatar = (avatarId) => {
  document.querySelectorAll('.avatar').forEach(img => img.classList.remove('selected'));
  document.getElementById(avatarId).classList.add('selected');
  selectedAvatar = document.getElementById(avatarId).src;
}  


