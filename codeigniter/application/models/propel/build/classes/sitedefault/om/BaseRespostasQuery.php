<?php


/**
 * Base class that represents a query for the 'respostas' table.
 *
 * 
 *
 * @method RespostasQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method RespostasQuery orderBySessionId($order = Criteria::ASC) Order by the SESSION_ID column
 * @method RespostasQuery orderByIp($order = Criteria::ASC) Order by the IP column
 * @method RespostasQuery orderByRespostas($order = Criteria::ASC) Order by the RESPOSTAS column
 * @method RespostasQuery orderByCreatedAt($order = Criteria::ASC) Order by the CREATED_AT column
 * @method RespostasQuery orderByUpdatedAt($order = Criteria::ASC) Order by the UPDATED_AT column
 *
 * @method RespostasQuery groupById() Group by the ID column
 * @method RespostasQuery groupBySessionId() Group by the SESSION_ID column
 * @method RespostasQuery groupByIp() Group by the IP column
 * @method RespostasQuery groupByRespostas() Group by the RESPOSTAS column
 * @method RespostasQuery groupByCreatedAt() Group by the CREATED_AT column
 * @method RespostasQuery groupByUpdatedAt() Group by the UPDATED_AT column
 *
 * @method RespostasQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RespostasQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RespostasQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Respostas findOne(PropelPDO $con = null) Return the first Respostas matching the query
 * @method Respostas findOneOrCreate(PropelPDO $con = null) Return the first Respostas matching the query, or a new Respostas object populated from the query conditions when no match is found
 *
 * @method Respostas findOneById(string $ID) Return the first Respostas filtered by the ID column
 * @method Respostas findOneBySessionId(string $SESSION_ID) Return the first Respostas filtered by the SESSION_ID column
 * @method Respostas findOneByIp(string $IP) Return the first Respostas filtered by the IP column
 * @method Respostas findOneByRespostas(string $RESPOSTAS) Return the first Respostas filtered by the RESPOSTAS column
 * @method Respostas findOneByCreatedAt(string $CREATED_AT) Return the first Respostas filtered by the CREATED_AT column
 * @method Respostas findOneByUpdatedAt(string $UPDATED_AT) Return the first Respostas filtered by the UPDATED_AT column
 *
 * @method array findById(string $ID) Return Respostas objects filtered by the ID column
 * @method array findBySessionId(string $SESSION_ID) Return Respostas objects filtered by the SESSION_ID column
 * @method array findByIp(string $IP) Return Respostas objects filtered by the IP column
 * @method array findByRespostas(string $RESPOSTAS) Return Respostas objects filtered by the RESPOSTAS column
 * @method array findByCreatedAt(string $CREATED_AT) Return Respostas objects filtered by the CREATED_AT column
 * @method array findByUpdatedAt(string $UPDATED_AT) Return Respostas objects filtered by the UPDATED_AT column
 *
 * @package    propel.generator.sitedefault.om
 */
abstract class BaseRespostasQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRespostasQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'sitedefault', $modelName = 'Respostas', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RespostasQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     RespostasQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RespostasQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RespostasQuery) {
            return $criteria;
        }
        $query = new RespostasQuery();
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
     * @return   Respostas|Respostas[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RespostasPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RespostasPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Respostas A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `SESSION_ID`, `IP`, `RESPOSTAS`, `CREATED_AT`, `UPDATED_AT` FROM `respostas` WHERE `ID` = :p0';
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
            $obj = new Respostas();
            $obj->hydrate($row);
            RespostasPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Respostas|Respostas[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Respostas[]|mixed the list of results, formatted by the current formatter
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
     * @return RespostasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RespostasPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RespostasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RespostasPeer::ID, $keys, Criteria::IN);
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
     * @return RespostasQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RespostasPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the SESSION_ID column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionId('fooValue');   // WHERE SESSION_ID = 'fooValue'
     * $query->filterBySessionId('%fooValue%'); // WHERE SESSION_ID LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sessionId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RespostasQuery The current query, for fluid interface
     */
    public function filterBySessionId($sessionId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sessionId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sessionId)) {
                $sessionId = str_replace('*', '%', $sessionId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RespostasPeer::SESSION_ID, $sessionId, $comparison);
    }

    /**
     * Filter the query on the IP column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE IP = 'fooValue'
     * $query->filterByIp('%fooValue%'); // WHERE IP LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RespostasQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ip)) {
                $ip = str_replace('*', '%', $ip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RespostasPeer::IP, $ip, $comparison);
    }

    /**
     * Filter the query on the RESPOSTAS column
     *
     * Example usage:
     * <code>
     * $query->filterByRespostas('fooValue');   // WHERE RESPOSTAS = 'fooValue'
     * $query->filterByRespostas('%fooValue%'); // WHERE RESPOSTAS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $respostas The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RespostasQuery The current query, for fluid interface
     */
    public function filterByRespostas($respostas = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($respostas)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $respostas)) {
                $respostas = str_replace('*', '%', $respostas);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RespostasPeer::RESPOSTAS, $respostas, $comparison);
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
     * @return RespostasQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(RespostasPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(RespostasPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RespostasPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return RespostasQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(RespostasPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(RespostasPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RespostasPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Respostas $respostas Object to remove from the list of results
     *
     * @return RespostasQuery The current query, for fluid interface
     */
    public function prune($respostas = null)
    {
        if ($respostas) {
            $this->addUsingAlias(RespostasPeer::ID, $respostas->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior
    
    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     RespostasQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(RespostasPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by update date desc
     *
     * @return     RespostasQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(RespostasPeer::UPDATED_AT);
    }
    
    /**
     * Order by update date asc
     *
     * @return     RespostasQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(RespostasPeer::UPDATED_AT);
    }
    
    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     RespostasQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(RespostasPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by create date desc
     *
     * @return     RespostasQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(RespostasPeer::CREATED_AT);
    }
    
    /**
     * Order by create date asc
     *
     * @return     RespostasQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(RespostasPeer::CREATED_AT);
    }
}
