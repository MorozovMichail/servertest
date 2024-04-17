<?php

declare(strict_types=1);

enum Areas: string
{
    case AREA1 = 'Область1';
    case AREA2 = 'Область2';
    case AREA3 = 'Область3';
}

class Database
{
    private string $host;
    private string $dbname;
    private string $user;
    private string $password;
    private \PDO $pdo;

    public function __construct(string $host, string $dbname, string $user, string $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function connect(): void
    {
        $dsn = "pgsql:host={$this->host};dbname={$this->dbname}";
        $this->pdo = new \PDO($dsn, $this->user, $this->password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getRegionByArea(Areas $area): ?string
    {
        $stmt = $this->pdo->prepare('SELECT title FROM region WHERE area = :area');
        $stmt->execute([':area' => $area->value]);
        return $stmt->fetchColumn();
    }
}
