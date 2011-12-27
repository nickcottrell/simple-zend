<?php

class Application_Model_PageaboutMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Pageabout');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Pageabout $pageabout)
    {
        $data = array(
            'pagetitle'   => $pageabout->getPagetitle(),
            'content' => $pageabout->getContent(	),
            'created' => date('m/d/Y'),
        );

        if (null === ($id = $pageabout->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }

    }

    public function find($id, Application_Model_Pageabout $pageabout)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $pageabout->setId($row->id)
                  ->setPagetitle($row->pagetitle)
                  ->setContent($row->content)
                  ->setCreated($row->created);
    }

    public function fetchAll()
    {	
		$where = null;
		$orderBy = 'id DESC';
		$count = 1;
		$offset = 0;
        $resultSet = $this->getDbTable()->fetchAll($where, $orderBy, $count, $offset);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Pageabout();
            $entry->setId($row->id)
                  ->setPagetitle($row->pagetitle)
                  ->setContent($row->content)
                  ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }
}

