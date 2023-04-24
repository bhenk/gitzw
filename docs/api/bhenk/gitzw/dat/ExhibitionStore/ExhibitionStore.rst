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

.. _bhenk\gitzw\dat\ExhibitionStore:

ExhibitionStore
===============

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\gitzw\\dat        
   predicates Cloneable | Instantiable 
   ========== ======================== 


**Store for obtaining and persisting Exhibitions**


.. contents::


----


.. _bhenk\gitzw\dat\ExhibitionStore::Constants:

Constants
+++++++++


.. _bhenk\gitzw\dat\ExhibitionStore::SERIALIZATION_DIRECTORY:

ExhibitionStore::SERIALIZATION_DIRECTORY
----------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(11) "exhibitions" 




----


.. _bhenk\gitzw\dat\ExhibitionStore::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\ExhibitionStore::persist:

ExhibitionStore::persist
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Persist the given Exhibition**


The :ref:`bhenk\gitzw\dat\Exhibition` is inserted or updated. :ref:`bhenk\gitzw\dat\ExhibitionRelations` of the Exhibition are
inserted, updated or deleted.



.. code-block:: php

   public function persist(
         Parameter #0 [ <required> bhenk\gitzw\dat\Exhibition $exhibition ]
    ): Exhibition


| :tag6:`param` :ref:`bhenk\gitzw\dat\Exhibition` :param:`$exhibition` - the Exhibition to persist
| :tag6:`return` :ref:`bhenk\gitzw\dat\Exhibition`  - the Exhibition after persistence (includes Primary ID)
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::persistBatch:

ExhibitionStore::persistBatch
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function persistBatch(
         Parameter #0 [ <required> array $exhibitions ]
    ): array


| :tag6:`param` array :param:`$exhibitions`
| :tag6:`return` array
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::selectBatch:

ExhibitionStore::selectBatch
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Exhibitions with given IDs**


.. code-block:: php

   public function selectBatch(
         Parameter #0 [ <required> array $IDs ]
    ): array


| :tag6:`param` array :param:`$IDs` - Exhibition IDs
| :tag6:`return` array  - array of stored Exhibitions
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::deleteBatch:

ExhibitionStore::deleteBatch
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete Exhibitions**


.. code-block:: php

   public function deleteBatch(
         Parameter #0 [ <required> array $exhibitions ]
    ): int


| :tag6:`param` array :param:`$exhibitions` - IDs, RESIDs or Exhibitions to delete
| :tag6:`return` int  - count of deleted Exhibitions
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::delete:

ExhibitionStore::delete
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete a Exhibition**


.. code-block:: php

   public function delete(
         Parameter #0 [ <required> bhenk\gitzw\dat\Exhibition|string|int $exhibition ]
    ): int


| :tag6:`param` :ref:`bhenk\gitzw\dat\Exhibition` | string | int :param:`$exhibition`
| :tag6:`return` int  - rows affected
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::get:

ExhibitionStore::get
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function get(
         Parameter #0 [ <required> bhenk\gitzw\dat\Exhibition|string|int $exhibition ]
    ): Exhibition|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Exhibition` | string | int :param:`$exhibition`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Exhibition` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::select:

ExhibitionStore::select
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Exhibition with given ID**


.. code-block:: php

   public function select(
         Parameter #0 [ <required> int $ID ]
    ): Exhibition|bool


| :tag6:`param` int :param:`$ID`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Exhibition` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::selectByEXHID:

ExhibitionStore::selectByEXHID
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Exhibition with given alternative EXHID**


.. code-block:: php

   public function selectByEXHID(
         Parameter #0 [ <required> string $EXHID ]
    ): Exhibition|bool


| :tag6:`param` string :param:`$EXHID`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Exhibition` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::selectWhere:

ExhibitionStore::selectWhere
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Exhibitions with a where-clause**


.. code-block:: php

   public function selectWhere(
         Parameter #0 [ <required> string $where ]
         Parameter #1 [ <optional> int $offset = 0 ]
         Parameter #2 [ <optional> int $limit = bhenk\gitzw\dat\PHP_INT_MAX ]
    ): array


| :tag6:`param` string :param:`$where` - expression
| :tag6:`param` int :param:`$offset` - start index
| :tag6:`param` int :param:`$limit` - max number of Exhibitions to return
| :tag6:`return` array  - Exhibition> array of Exhibitions or empty array if end of storage reached
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::deleteWhere:

ExhibitionStore::deleteWhere
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete Exhibitions with a where-clause**


.. code-block:: php

   public function deleteWhere(
         Parameter #0 [ <required> string $where ]
    ): int


| :tag6:`param` string :param:`$where` - expression
| :tag6:`return` int  - count of deleted Exhibitions
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::selectEXHIDsWhere:

ExhibitionStore::selectEXHIDsWhere
----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select EXHIDS for given year**


.. code-block:: php

   public function selectEXHIDsWhere(
         Parameter #0 [ <required> int $year ]
    ): array


| :tag6:`param` int :param:`$year`
| :tag6:`return` array
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::serialize:

ExhibitionStore::serialize
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Serialize all the Exhibitions**

| :tag12:`noinspection` DuplicatedCode


.. code-block:: php

   public function serialize(
         Parameter #0 [ <required> string $datastore ]
    ): array


| :tag6:`param` string :param:`$datastore` - directory for serialization files
| :tag6:`return` array  - [count of serialized exhibitions, count of serialized relations]
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionStore::deserialize:

ExhibitionStore::deserialize
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Deserialize from serialization files and store Exhibitions and ExhibitionRelations**


.. code-block:: php

   public function deserialize(
         Parameter #0 [ <required> string $datastore ]
    ): array


| :tag6:`param` string :param:`$datastore` - directory where to find serialization files
| :tag6:`return` array  - array[count of deserialized exhibitions, count of deserialized relations]
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----

:block:`no datestamp` 
