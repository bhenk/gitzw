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

.. _bhenk\gitzw\dat\CreatorStore:

CreatorStore
============

.. table::
   :widths: auto
   :align: left

   ========== ================================= 
   namespace  bhenk\\gitzw\\dat                 
   predicates Cloneable | Instantiable          
   uses       :ref:`bhenk\gitzw\dat\RulesTrait` 
   ========== ================================= 


**Stores Creators**


.. contents::


----


.. _bhenk\gitzw\dat\CreatorStore::Constants:

Constants
+++++++++


.. _bhenk\gitzw\dat\CreatorStore::SERIALIZATION_DIRECTORY:

CreatorStore::SERIALIZATION_DIRECTORY
-------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(8) "creators" 




----


.. _bhenk\gitzw\dat\CreatorStore::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\CreatorStore::persist:

CreatorStore::persist
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Persist the given Creator**


The :ref:`bhenk\gitzw\dat\Creator` is inserted or updated



.. code-block:: php

   public function persist(
         Parameter #0 [ <required> bhenk\gitzw\dat\Creator $creator ]
    ): Creator


| :tag6:`param` :ref:`bhenk\gitzw\dat\Creator` :param:`$creator` - the Creator to persist
| :tag6:`return` :ref:`bhenk\gitzw\dat\Creator`  - the Creator after persistence (includes Primary ID)
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::persistBatch:

CreatorStore::persistBatch
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function persistBatch(
         Parameter #0 [ <required> array $creators ]
    ): array


| :tag6:`param` array :param:`$creators`
| :tag6:`return` array
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::get:

CreatorStore::get
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Try and get the Creator**


.. code-block:: php

   public function get(
         Parameter #0 [ <required> bhenk\gitzw\dat\Creator|string|int $creator ]
    ): Creator|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Creator` | string | int :param:`$creator` - Creator ID (int), Creator CRID (string) or Creator (object)
| :tag6:`return` :ref:`bhenk\gitzw\dat\Creator` | bool  - the Creator or *false* if Creator with ID not in store
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::select:

CreatorStore::select
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select the Creator with the given ID**


.. code-block:: php

   public function select(
         Parameter #0 [ <required> int $ID ]
    ): Creator|bool


| :tag6:`param` int :param:`$ID` - Creator ID
| :tag6:`return` :ref:`bhenk\gitzw\dat\Creator` | bool  - Creator or *false* if Creator with ID not in store
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::selectByCRID:

CreatorStore::selectByCRID
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select the Creator with the alternative ID CRID**


.. code-block:: php

   public function selectByCRID(
         Parameter #0 [ <required> string $CRID ]
    ): Creator|bool


| :tag6:`param` string :param:`$CRID` - alternative Creator ID
| :tag6:`return` :ref:`bhenk\gitzw\dat\Creator` | bool  - Creator or *false* if Creator with CRID not in store
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::selectWhere:

CreatorStore::selectWhere
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Creators with a where-clause**


.. code-block:: php

   public function selectWhere(
         Parameter #0 [ <required> string $where ]
         Parameter #1 [ <optional> int $offset = 0 ]
         Parameter #2 [ <optional> int $limit = bhenk\gitzw\dat\PHP_INT_MAX ]
    ): array


| :tag6:`param` string :param:`$where` - expression
| :tag6:`param` int :param:`$offset` - start index
| :tag6:`param` int :param:`$limit` - maximum number of creators to return
| :tag6:`return` array  - array of Creators or empty array if end of storage reached
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::selectBatch:

CreatorStore::selectBatch
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Creators with given IDs**


.. code-block:: php

   public function selectBatch(
         Parameter #0 [ <required> array $IDs ]
    ): array


| :tag6:`param` array :param:`$IDs` - Creator IDs
| :tag6:`return` array  - array of stored Creators
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::delete:

CreatorStore::delete
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete a Creator**


.. code-block:: php

   public function delete(
         Parameter #0 [ <required> bhenk\gitzw\dat\Creator|string|int $creator ]
    ): int


| :tag6:`param` :ref:`bhenk\gitzw\dat\Creator` | string | int :param:`$creator`
| :tag6:`return` int  - count of deleted Creators
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::deleteWhere:

CreatorStore::deleteWhere
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete Creators with a where-clause**


.. code-block:: php

   public function deleteWhere(
         Parameter #0 [ <required> string $where ]
    ): int


| :tag6:`param` string :param:`$where` - expression
| :tag6:`return` int  - count of deleted Creators
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::deleteBatch:

CreatorStore::deleteBatch
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete Creators**


This method filters Creators before deletion on rules for creator deletion



.. code-block:: php

   public function deleteBatch(
         Parameter #0 [ <required> array $creators ]
    ): int


| :tag6:`param` array :param:`$creators` - can be mixed array
| :tag6:`return` int  - count of deleted Creators
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::serialize:

CreatorStore::serialize
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Serialize all the Creators**

| :tag12:`noinspection` DuplicatedCode


.. code-block:: php

   public function serialize(
         Parameter #0 [ <required> string $datastore ]
    ): int


| :tag6:`param` string :param:`$datastore` - directory for serialization files
| :tag6:`return` int  - count of serialized creators
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::deserialize:

CreatorStore::deserialize
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Deserialize from serialization files and store Creators**


.. code-block:: php

   public function deserialize(
         Parameter #0 [ <required> string $datastore ]
    ): int


| :tag6:`param` string :param:`$datastore` - directory where to find serialization files
| :tag6:`return` int  - count of deserialized creators
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\CreatorStore::getLastMessage:

CreatorStore::getLastMessage
----------------------------

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


.. _bhenk\gitzw\dat\CreatorStore::getMessages:

CreatorStore::getMessages
-------------------------

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


.. _bhenk\gitzw\dat\CreatorStore::getMessagesAsString:

CreatorStore::getMessagesAsString
---------------------------------

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


.. _bhenk\gitzw\dat\CreatorStore::addMessage:

CreatorStore::addMessage
------------------------

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


.. _bhenk\gitzw\dat\CreatorStore::resetMessages:

CreatorStore::resetMessages
---------------------------

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


.. _bhenk\gitzw\dat\CreatorStore::exhibitionCanAddRepresentation:

CreatorStore::exhibitionCanAddRepresentation
--------------------------------------------

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


.. _bhenk\gitzw\dat\CreatorStore::workCanAddRepresentation:

CreatorStore::workCanAddRepresentation
--------------------------------------

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


.. _bhenk\gitzw\dat\CreatorStore::exhibitionCanRemoveRepresentation:

CreatorStore::exhibitionCanRemoveRepresentation
-----------------------------------------------

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


.. _bhenk\gitzw\dat\CreatorStore::workCanRemoveRepresentation:

CreatorStore::workCanRemoveRepresentation
-----------------------------------------

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
