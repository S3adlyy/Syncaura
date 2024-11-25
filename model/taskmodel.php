<?php
/*class Task {
    private ?int $id;
    private ?string $nom;
    private ?DateTime $date;
    private ?int $etat;
    private ?int $plan_id;

    public function __construct($id = null, $nom = null, $date = null, $etat = null, $plan_id = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->date = $date ? new DateTime($date) : null;
        $this->etat = $etat;
        $this->plan_id = $plan_id;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getDate() {
        return $this->date;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function getPlanId() {
        return $this->plan_id;
    }

    // Display task as a table
    public function show() {
        $status = $this->etat === 1 ? "Completed" : "In Progress";
        echo "<table border=1>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Plan ID</th>
                </tr>
                <tr>
                    <td>{$this->id}</td>
                    <td>{$this->nom}</td>
                    <td>{$this->date ? $this->date->format('Y-m-d') : 'N/A'}</td>
                    <td>{$status}</td>
                    <td>{$this->plan_id}</td>
                </tr>
            </table>";
    }
}
?>
*/