function insert(num){
  document.form.textview.value = document.form.textview.value + num
}
function back(){
  var expr = document.form.textview.value;
  document.form.textview.value = expr.substring(0,expr.length-1)
}
function clean(){
  document.form.textview.value = ''
}
function equal(){
  var expr = document.form.textview.value;
  document.form.textview.value = eval(expr)
}