<?php

class Application_Model_QuickpostMapper
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
            $this->setDbTable('Application_Model_DbTable_Quickpost');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Quickpost $quickpost)
    {
        $data = array(
            'email'   => $quickpost->getEmail(),
            'comment' => $quickpost->getComment(	),
            'created' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $quickpost->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }


    public function delete(Application_Model_Quickpost $quickpost)
    {
        $data = array(
            'email'   => $quickpost->getEmail(),
            'comment' => $quickpost->getComment(),
            'created' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $quickpost->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }

    }

    public function find($id, Application_Model_Quickpost $quickpost)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $quickpost->setId($row->id)
                  ->setEmail($row->email)
                  ->setComment($row->comment)
                  ->setCreated($row->created);
    }

    public function fetchAll()
    {	
		$where = null;
		$orderBy = 'id DESC';
		$count = 7;
		$offset = 0;
        $resultSet = $this->getDbTable()->fetchAll($where, $orderBy, $count, $offset);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Quickpost();
            $entry->setId($row->id)
                  ->setEmail($row->email)
                  ->setComment($row->comment)
                  ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }
}

