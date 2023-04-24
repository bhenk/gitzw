.. required styles !!
.. raw:: html

    <style> .block {color:lightgrey; font-size: 0.6em; display: block; align-items: center; background-color:black; width:8em; height:8em;padding-left:7px;} </style>
    <style> .tag0 {color:grey; font-size: 0.9em; font-family: "Courier New", monospace;} </style>
    <style> .tag3 {color:grey; font-size: 0.9em; display: inline-block; width:3.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag4 {color:grey; font-size: 0.9em; display: inline-block; width:4.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag5 {color:grey; font-size: 0.9em; display: inline-block; width:5.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag6 {color:grey; font-size: 0.9em; display: inline-block; width:6.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag7 {color:grey; font-size: 0.9em; display: inline-block; width:7.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag8 {color:grey; font-size: 0.9em; display: inline-block; width:8.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag9 {color:grey; font-size: 0.9em; display: inline-block; width:9.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag10 {color:grey; font-size: 0.9em; display: inline-block; width:10.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag11 {color:grey; font-size: 0.9em; display: inline-block; width:11.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag12 {color:grey; font-size: 0.9em; display: inline-block; width:12.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tagsign {color:grey; font-size: 0.9em; display: inline-block; width:3.2em;} </style>
    <style> .param {color:#005858; background-color:#F8F8F8; font-size: 0.8em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>
    <style> .tech {color:#005858; background-color:#F8F8F8; font-size: 0.9em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>

.. end required styles

.. required roles !!
.. role:: block
.. role:: tag0
.. role:: tag3
.. role:: tag4
.. role:: tag5
.. role:: tag6
.. role:: tag7
.. role:: tag8
.. role:: tag9
.. role:: tag10
.. role:: tag11
.. role:: tag12
.. role:: tagsign
.. role:: param
.. role:: tech

.. end required roles

.. _bhenk\gitzw\dao\RepresentationDao:

RepresentationDao
=================

.. table::
   :widths: auto
   :align: left

   ========== ======================================================================================== 
   namespace  bhenk\\gitzw\\dao                                                                        
   predicates Cloneable | Instantiable                                                                 
   extends    `AbstractDao <http://bhenkmsdata.rtfd.io/>`_                                             
   hierarchy  :ref:`bhenk\gitzw\dao\RepresentationDao` -> `AbstractDao <http://bhenkmsdata.rtfd.io/>`_ 
   ========== ======================================================================================== 


.. contents::


----


.. _bhenk\gitzw\dao\RepresentationDao::Constants:

Constants
+++++++++


.. _bhenk\gitzw\dao\RepresentationDao::TABLE_NAME:

RepresentationDao::TABLE_NAME
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(19) "tbl_representations" 




----


.. _bhenk\gitzw\dao\RepresentationDao::TABLE_DEFINITION_FILE:

RepresentationDao::TABLE_DEFINITION_FILE
----------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(90) "/Users/ecco/PhpstormProjects/gitzw/application/bhenk/gitzw/dao/sql/tbl_rep ...




----


.. _bhenk\gitzw\dao\RepresentationDao::Methods:

Methods
+++++++


.. _bhenk\gitzw\dao\RepresentationDao::getDataObjectName:

RepresentationDao::getDataObjectName
------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============================================================== 
   predicates public                                                          
   implements `AbstractDao::getDataObjectName <http://bhenkmsdata.rtfd.io/>`_ 
   ========== =============================================================== 






.. admonition:: @inheritdoc

    

   **Get the fully qualified classname of the** `Entity <https://www.google.com/search?q=Entity>`_ **this class provides access to**
   
   | :tag6:`return` string  - fully qualified classname
   
   ``@inheritdoc`` from method `AbstractDao::getDataObjectName <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public function getDataObjectName(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dao\RepresentationDao::selectByREPID:

RepresentationDao::selectByREPID
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function selectByREPID(
         Parameter #0 [ <required> string $REPID ]
    ): ?RepresentationDo


| :tag6:`param` string :param:`$REPID`
| :tag6:`return` ?\ :ref:`bhenk\gitzw\dao\RepresentationDo`
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dao\RepresentationDao::getTableName:

RepresentationDao::getTableName
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========================================================== 
   predicates public                                                     
   implements `AbstractDao::getTableName <http://bhenkmsdata.rtfd.io/>`_ 
   ========== ========================================================== 






.. admonition:: @inheritdoc

    

   **Get the name of the table that will store the** `Entity <https://www.google.com/search?q=Entity>`_ **this class provides access to**
   
   | :tag6:`return` string  - name of table reserved for DO
   
   ``@inheritdoc`` from method `AbstractDao::getTableName <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public function getTableName(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dao\RepresentationDao::getCreateTableStatement:

RepresentationDao::getCreateTableStatement
------------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ===================================================================== 
   predicates public                                                                
   implements `AbstractDao::getCreateTableStatement <http://bhenkmsdata.rtfd.io/>`_ 
   ========== ===================================================================== 






.. admonition:: @inheritdoc

    

   **Produces a minimal** *CreateTableStatement*
   
   
   
   
   ..  code-block::
   
      CREATE TABLE IF NOT EXISTS `%table_name%`
      (
           `ID`                INT NOT NULL AUTO_INCREMENT,
           `%int_prop%`        INT,
           `%string_prop%`     VARCHAR(255),
           `%bool_prop%`       BOOLEAN,
           `%float_prop%`      FLOAT,
           PRIMARY KEY (`ID`)
      );
   
   
   In the above :tech:`%xyz%` is placeholder for table name or property name. Notice that string type
   parameters have a limited length of 255 characters.
   
   Subclasses may override. The table MUST have the same name as the one returned by the method
   `AbstractDao::getTableName() <http://bhenkmsdata.rtfd.io/>`_.
   
   
   | :tag6:`return` string  - the :tech:`CREATE TABLE` sql
   | :tag6:`throws` `ReflectionException <https://www.php.net/manual/en/class.reflectionexception.php>`_
   
   ``@inheritdoc`` from method `AbstractDao::getCreateTableStatement <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public function getCreateTableStatement(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dao\RepresentationDao::dropTable:

RepresentationDao::dropTable
----------------------------

.. table::
   :widths: auto
   :align: left

   ============== ======================================================= 
   predicates     public                                                  
   inherited from `AbstractDao::dropTable <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ======================================================= 


**Drop table if it exists**


Tries to drop the table with the name returned by `AbstractDao::getTableName() <http://bhenkmsdata.rtfd.io/>`_.



.. code-block:: php

   public function dropTable(): bool


| :tag6:`return` bool  - *true* on success, even if table does not exist, *false* on failure
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dao\RepresentationDao::createTable:

RepresentationDao::createTable
------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================= 
   predicates     public                                                    
   inherited from `AbstractDao::createTable <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ========================================================= 


**Create a table in the database**


The statement used is the one from `AbstractDao::getCreateTableStatement() <http://bhenkmsdata.rtfd.io/>`_.



.. code-block:: php

   public function createTable(
         Parameter #0 [ <optional> bool $drop = false ]
    ): int


| :tag6:`param` bool :param:`$drop` - Drop (if exists) table with same name before create
| :tag6:`return` int  - count of executed statements
| :tag6:`throws` `ReflectionException <https://www.php.net/manual/en/class.reflectionexception.php>`_
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 200


----


.. _bhenk\gitzw\dao\RepresentationDao::insert:

RepresentationDao::insert
-------------------------

.. table::
   :widths: auto
   :align: left

   ============== ==================================================== 
   predicates     public                                               
   inherited from `AbstractDao::insert <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ==================================================== 


**Insert the given Entity**


With :tagsign:`param` :tech:`$insertID` set to *false* (this is the default), the :tech:`ID` of the `Entity <https://www.google.com/search?q=Entity>`_ (if any)
will be ignored. Returns an Entity equal to the
given Entity with the new :tech:`ID`.

In order to be able to reconstruct a table, the :tech:`ID` of the Entity can be inserted as well. Set
:tagsign:`param` :tech:`$insertID` to *true* to achieve this.



.. code-block:: php

   public function insert(
         Parameter #0 [ <required> bhenk\msdata\abc\Entity $entity ]
         Parameter #1 [ <optional> bool $insertID = false ]
    ): Entity


| :tag6:`param` `Entity <http://bhenkmsdata.rtfd.io/>`_ :param:`$entity` - Entity to insert
| :tag6:`param` bool :param:`$insertID` - should the *primary key* ID also be inserted
| :tag6:`return` `Entity <http://bhenkmsdata.rtfd.io/>`_  - new Entity, equal to given one, with new :tech:`ID`
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 201


----


.. _bhenk\gitzw\dao\RepresentationDao::insertBatch:

RepresentationDao::insertBatch
------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================= 
   predicates     public                                                    
   inherited from `AbstractDao::insertBatch <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ========================================================= 


**Insert the Entities from the given array**


The :tech:`ID` of the `Entity <https://www.google.com/search?q=Entity>`_ (if any) will be ignored. Returns an array of
Entities equal to the
given Entities with new :tech:`ID`\ s and ID as array key. This default behaviour can be altered by
providing a closure that receives each inserted entity and decides what key will be returned:

..  code-block::

   $func = function(Entity $entity): int {
       return  $entity->getID();
   };



In order to be able to reconstruct a table, the ID of the Entities can be inserted as well. Set
:tagsign:`param` :tech:`$insertID` to *true* to achieve this.



.. code-block:: php

   public function insertBatch(
         Parameter #0 [ <required> array $entity_array ]
         Parameter #1 [ <optional> ?Closure $func = NULL ]
         Parameter #2 [ <optional> bool $insertID = false ]
    ): array


| :tag6:`param` array :param:`$entity_array` - array of Entities to insert
| :tag6:`param` ?\ `Closure <https://www.php.net/manual/en/class.closure.php>`_ :param:`$func` - function to assign key in the returned array
| :tag6:`param` bool :param:`$insertID` - should the *primary key* ID also be inserted
| :tag6:`return` array  - array of Entities with new :tech:`ID`\ s
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 201


----


.. _bhenk\gitzw\dao\RepresentationDao::update:

RepresentationDao::update
-------------------------

.. table::
   :widths: auto
   :align: left

   ============== ==================================================== 
   predicates     public                                               
   inherited from `AbstractDao::update <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ==================================================== 


**Update the given Entity**


.. code-block:: php

   public function update(
         Parameter #0 [ <required> bhenk\msdata\abc\Entity $entity ]
    ): int


| :tag6:`param` `Entity <http://bhenkmsdata.rtfd.io/>`_ :param:`$entity` - persisted Entity to update
| :tag6:`return` int  - rows affected: 1 for success, 0 for failure
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 202


----


.. _bhenk\gitzw\dao\RepresentationDao::updateBatch:

RepresentationDao::updateBatch
------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================= 
   predicates     public                                                    
   inherited from `AbstractDao::updateBatch <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ========================================================= 


**Update the Entities in the given array**


.. code-block:: php

   public function updateBatch(
         Parameter #0 [ <required> array $entity_array ]
    ): int


| :tag6:`param` array :param:`$entity_array` - array of persisted Entities to update
| :tag6:`return` int  - rows affected
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 202


----


.. _bhenk\gitzw\dao\RepresentationDao::delete:

RepresentationDao::delete
-------------------------

.. table::
   :widths: auto
   :align: left

   ============== ==================================================== 
   predicates     public                                               
   inherited from `AbstractDao::delete <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ==================================================== 


**Delete the row with the given ID**


.. code-block:: php

   public function delete(
         Parameter #0 [ <required> int $ID ]
    ): int


| :tag6:`param` int :param:`$ID` - the :tech:`ID` to delete
| :tag6:`return` int  - rows affected: 1 for success, 0 if :tech:`ID` was not present
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 203


----


.. _bhenk\gitzw\dao\RepresentationDao::deleteBatch:

RepresentationDao::deleteBatch
------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================= 
   predicates     public                                                    
   inherited from `AbstractDao::deleteBatch <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ========================================================= 


**Delete rows with the given IDs**


.. code-block:: php

   public function deleteBatch(
         Parameter #0 [ <required> array $ids ]
    ): int


| :tag6:`param` array :param:`$ids` - array with IDs of persisted entities
| :tag6:`return` int  - affected rows
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 203


----


.. _bhenk\gitzw\dao\RepresentationDao::select:

RepresentationDao::select
-------------------------

.. table::
   :widths: auto
   :align: left

   ============== ==================================================== 
   predicates     public                                               
   inherited from `AbstractDao::select <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ==================================================== 


**Fetch the Entity with the given ID**


.. code-block:: php

   public function select(
         Parameter #0 [ <required> int $ID ]
    ): ?Entity


| :tag6:`param` int :param:`$ID` - the :tech:`ID` to fetch
| :tag6:`return` ?\ `Entity <http://bhenkmsdata.rtfd.io/>`_  - Entity with given :tech:`ID` or *null* if not present
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 204


----


.. _bhenk\gitzw\dao\RepresentationDao::selectBatch:

RepresentationDao::selectBatch
------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================= 
   predicates     public                                                    
   inherited from `AbstractDao::selectBatch <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ========================================================= 


**Select Entities with the given IDs**


The returned Entity[] array has Entity IDs as keys.



.. code-block:: php

   public function selectBatch(
         Parameter #0 [ <required> array $ids ]
    ): array


| :tag6:`param` array :param:`$ids` - array of IDs of persisted Entities
| :tag6:`return` array  - array of Entities or empty array if none found
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 204


----


.. _bhenk\gitzw\dao\RepresentationDao::deleteWhere:

RepresentationDao::deleteWhere
------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================= 
   predicates     public                                                    
   inherited from `AbstractDao::deleteWhere <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ========================================================= 


**Delete Entity rows with a** *where-clause*



..  code-block::

   DELETE FROM %table_name% WHERE %expression%





.. code-block:: php

   public function deleteWhere(
         Parameter #0 [ <required> string $where_clause ]
    ): int


| :tag6:`param` string :param:`$where_clause` - expression
| :tag6:`return` int  - rows affected
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 203


----


.. _bhenk\gitzw\dao\RepresentationDao::selectWhere:

RepresentationDao::selectWhere
------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================= 
   predicates     public                                                    
   inherited from `AbstractDao::selectWhere <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ========================================================= 


**Select Entities with a** *where-clause*



..  code-block::

   SELECT FROM %table_name% WHERE %expression% LIMIT %offset%, %limit%;


The optional :tagsign:`param` :tech:`$func` receives selected Entities and can decide what key
the Entity will have in the returned Entity[] array.
Default: the returned Entity[] array has Entity IDs as keys.

..  code-block::

   $func = function(Entity $entity): int {
       return  $entity->getID();
   };





.. code-block:: php

   public function selectWhere(
         Parameter #0 [ <required> string $where_clause ]
         Parameter #1 [ <optional> int $offset = 0 ]
         Parameter #2 [ <optional> int $limit = bhenk\msdata\abc\PHP_INT_MAX ]
         Parameter #3 [ <optional> ?Closure $func = NULL ]
    ): array


| :tag6:`param` string :param:`$where_clause` - expression
| :tag6:`param` int :param:`$offset` - offset of the first row to return
| :tag6:`param` int :param:`$limit` - the maximum number of rows to return
| :tag6:`param` ?\ `Closure <https://www.php.net/manual/en/class.closure.php>`_ :param:`$func` - if given decides which keys the returned array will have
| :tag6:`return` array  - array of Entities or empty array if none found
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - code 204


----


.. _bhenk\gitzw\dao\RepresentationDao::execute:

RepresentationDao::execute
--------------------------

.. table::
   :widths: auto
   :align: left

   ============== ===================================================== 
   predicates     public                                                
   inherited from `AbstractDao::execute <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ===================================================== 


**Execute the given query**


.. code-block:: php

   public function execute(
         Parameter #0 [ <required> string $sql ]
    ): array|bool


| :tag6:`param` string :param:`$sql`
| :tag6:`return` array | bool  - result rows in array; bool if result is boolean
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----

:block:`no datestamp` 
