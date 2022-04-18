<?php



/**
 * This class defines the structure of the 'respostas' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.sitedefault.map
 */
class RespostasTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'sitedefault.map.RespostasTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('respostas');
        $this->setPhpName('Respostas');
        $this->setClassname('Respostas');
        $this->setPackage('sitedefault');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'VARCHAR', true, null, null);
        $this->addColumn('SESSION_ID', 'SessionId', 'VARCHAR', true, 255, null);
        $this->addColumn('IP', 'Ip', 'VARCHAR', true, 255, null);
        $this->addColumn('RESPOSTAS', 'Respostas', 'LONGVARCHAR', true, null, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'CREATED_AT', 'update_column' => 'UPDATED_AT', 'disable_updated_at' => 'false', 'add_columns' => 'false', ),
        );
    } // getBehaviors()

} // RespostasTableMap
