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

.. _bhenk\gitzw\model\StoredObjectInterface:

StoredObjectInterface
=====================

.. table::
   :widths: auto
   :align: left

   ===================== ======================================================================================================================================== 
   namespace             bhenk\\gitzw\\model                                                                                                                      
   predicates            Abstract | Interface                                                                                                                     
   implements            :ref:`bhenk\gitzw\model\JsonAwareInterface`                                                                                              
   known implementations :ref:`bhenk\gitzw\dat\Creator` | :ref:`bhenk\gitzw\dat\Exhibition` | :ref:`bhenk\gitzw\dat\Representation` | :ref:`bhenk\gitzw\dat\Work` 
   ===================== ======================================================================================================================================== 


.. contents::


----


.. _bhenk\gitzw\model\StoredObjectInterface::Methods:

Methods
+++++++


.. _bhenk\gitzw\model\StoredObjectInterface::getID:

StoredObjectInterface::getID
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Get the ID of this JsonAware**


.. code-block:: php

   public abstract function getID(): ?int


| :tag6:`return` ?\ int  - ID or *null* if this JsonAware does not have an ID yet


----


.. _bhenk\gitzw\model\StoredObjectInterface::deserialize:

StoredObjectInterface::deserialize
----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========================== 
   predicates public | static | abstract 
   ========== ========================== 


**Deserialize the object from the given json string**


.. code-block:: php

   public static abstract function deserialize(
         Parameter #0 [ <required> string $serialized ]
    ): JsonAwareInterface


| :tag6:`param` string :param:`$serialized` - json string
| :tag6:`return` :ref:`bhenk\gitzw\model\JsonAwareInterface`  - rebirth of the serialized object


----


.. _bhenk\gitzw\model\StoredObjectInterface::serialize:

StoredObjectInterface::serialize
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Serialize this to a json string**


.. code-block:: php

   public abstract function serialize(): string


| :tag6:`return` string  - json string


----

:block:`no datestamp` 
