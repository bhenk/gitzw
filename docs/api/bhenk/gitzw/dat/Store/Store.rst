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

.. _bhenk\gitzw\dat\Store:

Store
=====

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\gitzw\\dat        
   predicates Cloneable | Instantiable 
   ========== ======================== 


**Persistence of business objects**


Besides facilitating access to specialized Stores, this Store is capable of persisting and recuperating
the entire business layer.


.. contents::


----


.. _bhenk\gitzw\dat\Store::Constants:

Constants
+++++++++


.. _bhenk\gitzw\dat\Store::DATA_DIR:

Store::DATA_DIR
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 




**Name of the directory where we expect to store data**



.. code-block:: php

   string(4) "data" 




----


.. _bhenk\gitzw\dat\Store::STORE_DIR:

Store::STORE_DIR
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 




**Name of the directory dedicated to store data from this Store**



.. code-block:: php

   string(5) "store" 




----


.. _bhenk\gitzw\dat\Store::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\Store::creatorStore:

Store::creatorStore
-------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Get the store for Creators**


.. code-block:: php

   public static function creatorStore(): CreatorStore


| :tag6:`return` :ref:`bhenk\gitzw\dat\CreatorStore`  - store for Creators


----


.. _bhenk\gitzw\dat\Store::representationStore:

Store::representationStore
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Get the store for Representations**


.. code-block:: php

   public static function representationStore(): RepresentationStore


| :tag6:`return` :ref:`bhenk\gitzw\dat\RepresentationStore`  - store for Representations


----


.. _bhenk\gitzw\dat\Store::workStore:

Store::workStore
----------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Get the store for Works**


.. code-block:: php

   public static function workStore(): WorkStore


| :tag6:`return` :ref:`bhenk\gitzw\dat\WorkStore`  - store for Works


----


.. _bhenk\gitzw\dat\Store::exhibitionStore:

Store::exhibitionStore
----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function exhibitionStore(): ?ExhibitionStore


| :tag6:`return` ?\ :ref:`bhenk\gitzw\dat\ExhibitionStore`


----


.. _bhenk\gitzw\dat\Store::nextRESID:

Store::nextRESID
----------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Get the next RESID for new Work**


.. code-block:: php

   public static function nextRESID(
         Parameter #0 [ <required> bhenk\gitzw\dat\Creator|string|int $creator ]
         Parameter #1 [ <required> bhenk\gitzw\model\WorkCategories $cat ]
         Parameter #2 [ <required> int $year ]
    ): string|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Creator` | string | int :param:`$creator`
| :tag6:`param` :ref:`bhenk\gitzw\model\WorkCategories` :param:`$cat`
| :tag6:`param` int :param:`$year`
| :tag6:`return` string | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\Store::nextEXHID:

Store::nextEXHID
----------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Get the next EXHID**


.. code-block:: php

   public static function nextEXHID(
         Parameter #0 [ <required> int $year ]
    ): string


| :tag6:`param` int :param:`$year`
| :tag6:`return` string
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\Store::getDataDirectory:

Store::getDataDirectory
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getDataDirectory(): string


| :tag6:`return` string
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\Store::getDataStore:

Store::getDataStore
-------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Get the data store directory for (de)serialization**


.. code-block:: php

   public static function getDataStore(): string


| :tag6:`return` string  - data store directory
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_  - if data store directory not found


----


.. _bhenk\gitzw\dat\Store::serialize:

Store::serialize
----------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function serialize(): array


| :tag6:`return` array  - counts of serialized business objects
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\Store::deserialize:

Store::deserialize
------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function deserialize(): array


| :tag6:`return` array  - counts of deserialized business objects
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----

:block:`no datestamp` 
