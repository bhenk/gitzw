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

.. _bhenk\gitzw\model\DimensionsInterface:

DimensionsInterface
===================

.. table::
   :widths: auto
   :align: left

   ===================== ============================= 
   namespace             bhenk\\gitzw\\model           
   predicates            Abstract | Interface          
   known implementations :ref:`bhenk\gitzw\dao\WorkDo` 
   ===================== ============================= 


.. contents::


----


.. _bhenk\gitzw\model\DimensionsInterface::Methods:

Methods
+++++++


.. _bhenk\gitzw\model\DimensionsInterface::setWidth:

DimensionsInterface::setWidth
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function setWidth(
         Parameter #0 [ <required> float $width ]
    ): void


| :tag6:`param` float :param:`$width`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\DimensionsInterface::getWidth:

DimensionsInterface::getWidth
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function getWidth(): float


| :tag6:`return` float


----


.. _bhenk\gitzw\model\DimensionsInterface::setHeight:

DimensionsInterface::setHeight
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function setHeight(
         Parameter #0 [ <required> float $height ]
    ): void


| :tag6:`param` float :param:`$height`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\DimensionsInterface::getHeight:

DimensionsInterface::getHeight
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function getHeight(): float


| :tag6:`return` float


----


.. _bhenk\gitzw\model\DimensionsInterface::setDepth:

DimensionsInterface::setDepth
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function setDepth(
         Parameter #0 [ <required> float $depth ]
    ): void


| :tag6:`param` float :param:`$depth`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\DimensionsInterface::getDepth:

DimensionsInterface::getDepth
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function getDepth(): float


| :tag6:`return` float


----

:block:`no datestamp` 
