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

.. _bhenk\gitzw\dat\RepresentationStore:

RepresentationStore
===================

.. table::
   :widths: auto
   :align: left

   ========== ================================= 
   namespace  bhenk\\gitzw\\dat                 
   predicates Cloneable | Instantiable          
   uses       :ref:`bhenk\gitzw\dat\RulesTrait` 
   ========== ================================= 


**Store for obtaining and persisting Representations**


.. contents::


----


.. _bhenk\gitzw\dat\RepresentationStore::Constants:

Constants
+++++++++


.. _bhenk\gitzw\dat\RepresentationStore::SERIALIZATION_DIRECTORY:

RepresentationStore::SERIALIZATION_DIRECTORY
--------------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(15) "representations" 




----


.. _bhenk\gitzw\dat\RepresentationStore::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\RepresentationStore::persist:

RepresentationStore::persist
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Persist the given Representation**


The :ref:`bhenk\gitzw\dat\Representation` is inserted or updated.



.. code-block:: php

   public function persist(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation $representation ]
    ): Representation


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` :param:`$representation` - the Representation to persist
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation`  - the Representation after persistence (including Primary Id)
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::persistBatch:

RepresentationStore::persistBatch
---------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function persistBatch(
         Parameter #0 [ <required> array $representations ]
    ): array


| :tag6:`param` array :param:`$representations`
| :tag6:`return` array
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::get:

RepresentationStore::get
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Try and get the Representation**


.. code-block:: php

   public function get(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): Representation|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation` - Representation ID (int), Representation REPID (string) or Representation (object)
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool  - the Representation or *false* if Representation with ID not in store
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::select:

RepresentationStore::select
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select the Representation with the given ID**


.. code-block:: php

   public function select(
         Parameter #0 [ <required> int $ID ]
    ): Representation|bool


| :tag6:`param` int :param:`$ID` - Representation ID
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool  - Representation or *false* if Representation with ID not in store
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::selectByREPID:

RepresentationStore::selectByREPID
----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select the Representation with the alternative ID REPID**


.. code-block:: php

   public function selectByREPID(
         Parameter #0 [ <required> string $REPID ]
    ): Representation|bool


| :tag6:`param` string :param:`$REPID` - alternative Representation ID
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool  - Representation or *false* if Representation with REPID not in store
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::selectWhere:

RepresentationStore::selectWhere
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Representations with a where-clause**


.. code-block:: php

   public function selectWhere(
         Parameter #0 [ <required> string $where ]
         Parameter #1 [ <optional> int $offset = 0 ]
         Parameter #2 [ <optional> int $limit = bhenk\gitzw\dat\PHP_INT_MAX ]
    ): array


| :tag6:`param` string :param:`$where` - expression
| :tag6:`param` int :param:`$offset` - start index
| :tag6:`param` int :param:`$limit` - maximum number of representations to return
| :tag6:`return` array  - array of Representations or empty array if end of storage reached
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::selectBatch:

RepresentationStore::selectBatch
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Select Representations with given IDs**


.. code-block:: php

   public function selectBatch(
         Parameter #0 [ <required> array $IDs ]
    ): array


| :tag6:`param` array :param:`$IDs` - Representation IDs
| :tag6:`return` array  - array of stored Representations
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::delete:

RepresentationStore::delete
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete a Representation**


.. code-block:: php

   public function delete(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): int


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation`
| :tag6:`return` int  - count of deleted Representations
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::deleteWhere:

RepresentationStore::deleteWhere
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete Representations with a where-clause**


This method filters Representations that can be deleted.

See :ref:`bhenk\gitzw\dat\RulesTrait::getLastMessage` for reasons.



.. code-block:: php

   public function deleteWhere(
         Parameter #0 [ <required> string $where ]
    ): int


| :tag6:`param` string :param:`$where` - expression
| :tag6:`return` int  - count of deleted Representations
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::deleteBatch:

RepresentationStore::deleteBatch
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Delete Representations**


This method filters Representations that can be deleted.

See :ref:`bhenk\gitzw\dat\RulesTrait::getLastMessage` for reasons.



.. code-block:: php

   public function deleteBatch(
         Parameter #0 [ <required> array $representations ]
    ): int


| :tag6:`param` array :param:`$representations` - Representations to delete
| :tag6:`return` int  - count of deleted Representations
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::serialize:

RepresentationStore::serialize
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Serialize all the Representations**

| :tag12:`noinspection` DuplicatedCode


.. code-block:: php

   public function serialize(
         Parameter #0 [ <required> string $datastore ]
    ): int


| :tag6:`param` string :param:`$datastore` - directory for serialization files
| :tag6:`return` int  - count of serialized representations
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::deserialize:

RepresentationStore::deserialize
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Deserialize from serialization files and store Representations**


.. code-block:: php

   public function deserialize(
         Parameter #0 [ <required> string $datastore ]
    ): int


| :tag6:`param` string :param:`$datastore` - directory where to find serialization files
| :tag6:`return` int  - count of deserialized representations
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationStore::getLastMessage:

RepresentationStore::getLastMessage
-----------------------------------

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


.. _bhenk\gitzw\dat\RepresentationStore::getMessages:

RepresentationStore::getMessages
--------------------------------

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


.. _bhenk\gitzw\dat\RepresentationStore::getMessagesAsString:

RepresentationStore::getMessagesAsString
----------------------------------------

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


.. _bhenk\gitzw\dat\RepresentationStore::addMessage:

RepresentationStore::addMessage
-------------------------------

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


.. _bhenk\gitzw\dat\RepresentationStore::resetMessages:

RepresentationStore::resetMessages
----------------------------------

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


.. _bhenk\gitzw\dat\RepresentationStore::exhibitionCanAddRepresentation:

RepresentationStore::exhibitionCanAddRepresentation
---------------------------------------------------

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


.. _bhenk\gitzw\dat\RepresentationStore::workCanAddRepresentation:

RepresentationStore::workCanAddRepresentation
---------------------------------------------

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


.. _bhenk\gitzw\dat\RepresentationStore::exhibitionCanRemoveRepresentation:

RepresentationStore::exhibitionCanRemoveRepresentation
------------------------------------------------------

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


.. _bhenk\gitzw\dat\RepresentationStore::workCanRemoveRepresentation:

RepresentationStore::workCanRemoveRepresentation
------------------------------------------------

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
