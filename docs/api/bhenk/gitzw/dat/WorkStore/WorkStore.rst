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

.. _bhenk\gitzw\dat\WorkStore:

WorkStore
=========

.. table::
   :widths: auto
   :align: left

   ========== ================================= 
   namespace  bhenk\\gitzw\\dat                 
   predicates Cloneable | Instantiable          
   uses       :ref:`bhenk\gitzw\dat\RulesTrait` 
   ========== ================================= 


**Store for obtaining and persisting Works**


.. contents::


----


.. _bhenk\gitzw\dat\WorkStore::Constants:

Constants
+++++++++


.. _bhenk\gitzw\dat\WorkStore::SERIALIZATION_DIRECTORY:

WorkStore::SERIALIZATION_DIRECTORY
----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(5) "works" 




----


.. _bhenk\gitzw\dat\WorkStore::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\WorkStore::persist:

WorkStore::persist
------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Persist the given Work**


The :ref:`bhenk\gitzw\dat\Work` is inserted or updated. :ref:`bhenk\gitzw\dat\WorkRelations` of the Work are
inserted, updated or deleted.



.. code-block:: php

   public function persist(
         Parameter #0 [ <required> bhenk\gitzw\dat\Work $work ]
    ): Work


| :tag6:`param` :ref:`bhenk\gitzw\dat\Work` :param:`$work` - the Work to persist
| :tag6:`return` :ref:`bhenk\gitzw\dat\Work`  - the Work after persistence (includes Primary ID)
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::persistBatch:

WorkStore::persistBatch
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function persistBatch(
         Parameter #0 [ <required> array $works ]
    ): array


| :tag6:`param` array :param:`$works`
| :tag6:`return` array
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::selectByCreator:

WorkStore::selectByCreator
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Works by Creator**


.. code-block:: php

   public function selectByCreator(
         Parameter #0 [ <required> bhenk\gitzw\dat\Creator|string|int $creator ]
         Parameter #1 [ <optional> int $offset = 0 ]
         Parameter #2 [ <optional> int $limit = bhenk\gitzw\dat\PHP_INT_MAX ]
    ): array


| :tag6:`param` :ref:`bhenk\gitzw\dat\Creator` | string | int :param:`$creator` - creatorID, CRID or Creator
| :tag6:`param` int :param:`$offset` - start index
| :tag6:`param` int :param:`$limit` - max number of Works to return
| :tag6:`return` array  - Work> array of Works or empty array if end of storage reached
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::get:

WorkStore::get
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function get(
         Parameter #0 [ <required> bhenk\gitzw\dat\Work|string|int $work ]
    ): Work|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Work` | string | int :param:`$work`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Work` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::select:

WorkStore::select
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Work with given ID**


.. code-block:: php

   public function select(
         Parameter #0 [ <required> int $ID ]
    ): Work|bool


| :tag6:`param` int :param:`$ID`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Work` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::selectByRESID:

WorkStore::selectByRESID
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Work with given alternative RESID**


.. code-block:: php

   public function selectByRESID(
         Parameter #0 [ <required> string $RESID ]
    ): Work|bool


| :tag6:`param` string :param:`$RESID`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Work` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::selectWhere:

WorkStore::selectWhere
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Works with a where-clause**


.. code-block:: php

   public function selectWhere(
         Parameter #0 [ <required> string $where ]
         Parameter #1 [ <optional> int $offset = 0 ]
         Parameter #2 [ <optional> int $limit = bhenk\gitzw\dat\PHP_INT_MAX ]
    ): array


| :tag6:`param` string :param:`$where` - expression
| :tag6:`param` int :param:`$offset` - start index
| :tag6:`param` int :param:`$limit` - max number of Works to return
| :tag6:`return` array  - Work> array of Works or empty array if end of storage reached
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::selectBatch:

WorkStore::selectBatch
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Works with given IDs**


.. code-block:: php

   public function selectBatch(
         Parameter #0 [ <required> array $IDs ]
    ): array


| :tag6:`param` array :param:`$IDs` - Work IDs
| :tag6:`return` array  - array of stored Works
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::deleteBatch:

WorkStore::deleteBatch
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete Works**


.. code-block:: php

   public function deleteBatch(
         Parameter #0 [ <required> array $works ]
    ): int


| :tag6:`param` array :param:`$works` - IDs, RESIDs or Works to delete
| :tag6:`return` int  - count of deleted Works
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::delete:

WorkStore::delete
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete a Work**


.. code-block:: php

   public function delete(
         Parameter #0 [ <required> bhenk\gitzw\dat\Work|string|int $work ]
         Parameter #1 [ <optional> bool $resetMessages = true ]
    ): int


| :tag6:`param` :ref:`bhenk\gitzw\dat\Work` | string | int :param:`$work`
| :tag6:`param` bool :param:`$resetMessages`
| :tag6:`return` int  - rows affected
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::deleteWhere:

WorkStore::deleteWhere
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete Works with a where-clause**


.. code-block:: php

   public function deleteWhere(
         Parameter #0 [ <required> string $where ]
    ): int


| :tag6:`param` string :param:`$where` - expression
| :tag6:`return` int  - count of deleted Works
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::selectRESIDsWhere:

WorkStore::selectRESIDsWhere
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function selectRESIDsWhere(
         Parameter #0 [ <required> int $year ]
         Parameter #1 [ <required> bhenk\gitzw\model\WorkCategories $cat ]
         Parameter #2 [ <optional> string $owner = 'hnq' ]
    ): array


| :tag6:`param` int :param:`$year`
| :tag6:`param` :ref:`bhenk\gitzw\model\WorkCategories` :param:`$cat`
| :tag6:`param` string :param:`$owner`
| :tag6:`return` array
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::serialize:

WorkStore::serialize
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Serialize all the Works**

| :tag12:`noinspection` DuplicatedCode


.. code-block:: php

   public function serialize(
         Parameter #0 [ <required> string $datastore ]
    ): array


| :tag6:`param` string :param:`$datastore` - directory for serialization files
| :tag6:`return` array  - [count of serialized works, count of serialized relations]
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::deserialize:

WorkStore::deserialize
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Deserialize from serialization files and store Works and WorkRelations**


.. code-block:: php

   public function deserialize(
         Parameter #0 [ <required> string $datastore ]
    ): array


| :tag6:`param` string :param:`$datastore` - directory where to find serialization files
| :tag6:`return` array  - array[count of deserialized works, count of deserialized relations]
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::getLastMessage:

WorkStore::getLastMessage
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get the last message or false if no message**


.. code-block:: php

   public function getLastMessage(): string|bool


| :tag6:`return` string | bool


----


.. _bhenk\gitzw\dat\WorkStore::getMessages:

WorkStore::getMessages
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getMessages(): array


| :tag6:`return` array


----


.. _bhenk\gitzw\dat\WorkStore::getMessagesAsString:

WorkStore::getMessagesAsString
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getMessagesAsString(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dat\WorkStore::addMessage:

WorkStore::addMessage
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 





.. code-block:: php

   protected function addMessage(
         Parameter #0 [ <required> string $message ]
    ): void


| :tag6:`param` string :param:`$message`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\WorkStore::resetMessages:

WorkStore::resetMessages
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 


.. code-block:: php

   protected function resetMessages(): void


| :tag6:`return` void


----


.. _bhenk\gitzw\dat\WorkStore::exhibitionCanAddRepresentation:

WorkStore::exhibitionCanAddRepresentation
-----------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 





.. code-block:: php

   protected function exhibitionCanAddRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): Representation|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::workCanAddRepresentation:

WorkStore::workCanAddRepresentation
-----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 





.. code-block:: php

   protected function workCanAddRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): Representation|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::exhibitionCanRemoveRepresentation:

WorkStore::exhibitionCanRemoveRepresentation
--------------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 





.. code-block:: php

   protected function exhibitionCanRemoveRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): Representation|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkStore::workCanRemoveRepresentation:

WorkStore::workCanRemoveRepresentation
--------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 





.. code-block:: php

   protected function workCanRemoveRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): Representation|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----

:block:`no datestamp` 
