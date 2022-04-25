<?php
namespace Model;

class Model
{
    protected $dbConnection = null;

    /**
     * Model constructor instantiate the DB connection
     */
    public function __construct()
    {
        try
        {
            $this->dbConnection = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

            if(mysqli_connect_errno())
            {
                throw new \Exception("Database connection failed");
            }
        }
        catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Query function where helps in executing a DB statement and returning the result of the READ query
     * 
     * @param string $query DB query statement.
     */
    public function query($query = "")
    {
        try
        {
            $dbStatement = $this->execStatement($query);
            
            $result = $dbStatement->get_result()->fetch_all(MYSQLI_ASSOC);

            $dbStatement->close();

            return $result;
        }
        catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Execute function where helps in executing a DB statement only such as CREATE, UPDATE, DELETE
     * 
     * @param string $query DB query statement.
     */
    public function execute($query = "")
    {
        try
        {
            $dbStatement = $this->execStatement($query);
            return $dbStatement;
            
        }
        catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * A general SQL query execution function
     * 
     * @param string $query DB query statement.
     */
    private function execStatement($query = "")
    {
        try
        {
            $dbStatement = $this->dbConnection->prepare($query);

            if($dbStatement == false)
            {
                throw new \Exception("Invalid DB statement: ".$query);
            }

            $dbStatement->execute();

            return $dbStatement;
        }
        catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }
}

?>