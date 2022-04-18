<?php


/**
 * Base class that represents a query for the 'perguntas' table.
 *
 * 
 *
 * @method PerguntasQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method PerguntasQuery orderByPergunta($order = Criteria::ASC) Order by the PERGUNTA column
 * @method PerguntasQuery orderByCreatedAt($order = Criteria::ASC) Order by the CREATED_AT column
 * @method PerguntasQuery orderByUpdatedAt($order = Criteria::ASC) Order by the UPDATED_AT column
 *
 * @method PerguntasQuery groupById() Group by the ID column
 * @method PerguntasQuery groupByPergunta() Group by the PERGUNTA column
 * @method PerguntasQuery groupByCreatedAt() Group by the CREATED_AT column
 * @method PerguntasQuery groupByUpdatedAt() Group by the UPDATED_AT column
 *
 * @method PerguntasQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PerguntasQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PerguntasQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Perguntas findOne(PropelPDO $con = null) Return the first Perguntas matching the query
 * @method Perguntas findOneOrCreate(PropelPDO $con = null) Return the first Perguntas matching the query, or a new Perguntas object populated from the query conditions when no match is found
 *
 * @method Perguntas findOneById(string $ID) Return the first Perguntas filtered by the ID column
 * @method Perguntas findOneByPergunta(string $PERGUNTA) Return the first Perguntas filtered by the PERGUNTA column
 * @method Perguntas findOneByCreatedAt(string $CREATED_AT) Return the first Perguntas filtered by the CREATED_AT column
 * @method Perguntas findOneByUpdatedAt(string $UPDATED_AT) Return the first Perguntas filtered by the UPDATED_AT column
 *
 * @method array findById(string $ID) Return Perguntas objects filtered by the ID column
 * @method array findByPergunta(string $PERGUNTA) Return Perguntas objects filtered by the PERGUNTA column
 * @method array findByCreatedAt(string $CREATED_AT) Return Perguntas objects filtered by the CREATED_AT column
 * @method array findByUpdatedAt(string $UPDATED_AT) Return Perguntas objects filtered by the UPDATED_AT column
 *
 * @package    propel.generator.sitedefault.om
 */
abstract class BasePerguntasQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePerguntasQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'sitedefault', $modelName = 'Perguntas', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PerguntasQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PerguntasQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PerguntasQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PerguntasQuery) {
            return $criteria;
        }
        $query = new PerguntasQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query 
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Perguntas|Perguntas[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PerguntasPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PerguntasPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Perguntas A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `PERGUNTA`, `CREATED_AT`, `UPDATED_AT` FROM `perguntas` WHERE `ID` = :p0';
        try {
            $stmt = $con->prepare($sql);			
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Perguntas();
            $obj->hydrate($row);
            PerguntasPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Perguntas|Perguntas[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Perguntas[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return PerguntasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PerguntasPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PerguntasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PerguntasPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE ID = 'fooValue'
     * $query->filterById('%fooValue%'); // WHERE ID LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PerguntasQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $id)) {
                $id = str_replace('*', '%', $id);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PerguntasPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the PERGUNTA column
     *
     * Example usage:
     * <code>
     * $query->filterByPergunta('fooValue');   // WHERE PERGUNTA = 'fooValue'
     * $query->filterByPergunta('%fooValue%'); // WHERE PERGUNTA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pergunta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PerguntasQuery The current query, for fluid interface
     */
    public function filterByPergunta($pergunta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pergunta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pergunta)) {
                $pergunta = str_replace('*', '%', $pergunta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PerguntasPeer::PERGUNTA, $pergunta, $comparison);
    }

    /**
     * Filter the query on the CREATED_AT column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE CREATED_AT = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE CREATED_AT = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE CREATED_AT > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PerguntasQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PerguntasPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PerguntasPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PerguntasPeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the UPDATED_AT column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE UPDATED_AT = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE UPDATED_AT = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE UPDATED_AT > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PerguntasQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PerguntasPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PerguntasPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PerguntasPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Perguntas $perguntas Object to remove from the list of results
     *
     * @return PerguntasQuery The current query, for fluid interface
     */
    public function prune($perguntas = null)
    {
        if ($perguntas) {
            $this->addUsingAlias(PerguntasPeer::ID, $perguntas->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior
    
    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     PerguntasQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PerguntasPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by update date desc
     *
     * @return     PerguntasQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PerguntasPeer::UPDATED_AT);
    }
    
    /**
     * Order by update date asc
     *
     * @return     PerguntasQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PerguntasPeer::UPDATED_AT);
    }
    
    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PerguntasQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PerguntasPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by create date desc
     *
     * @return     PerguntasQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PerguntasPeer::CREATED_AT);
    }
    
    /**
     * Order by create date asc
     *
     * @return     PerguntasQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PerguntasPeer::CREATED_AT);
    }
}
