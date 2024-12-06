<?php
class Plan {
    private ?int $id;
    private ?string $nom;
    private ?DateTime $date_plan;

    public function __construct($id = null, $nom = null, $date_plan = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->date_plan = $date_plan ? new DateTime($date_plan) : null;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getDatePlan() {
        return $this->date_plan;
    }

    // Show
    public function show() {
        echo "<table border=1>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                </tr>
                <tr>
                    <td>{$this->id}</td>
                    <td>{$this->nom}</td>
                    <td>{$this->date_plan->format('Y-m-d')}</td>
                </tr>
            </table>";
    }
}
