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

.. _bhenk\gitzw\model\DimensionsTrait:

DimensionsTrait
===============

.. table::
   :widths: auto
   :align: left

   ========== =================== 
   namespace  bhenk\\gitzw\\model 
   predicates Trait               
   ========== =================== 


.. contents::


----


.. _bhenk\gitzw\model\DimensionsTrait::Constants:

Constants
+++++++++


.. _bhenk\gitzw\model\DimensionsTrait::CM_TO_IN:

DimensionsTrait::CM_TO_IN
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   float(2.54) 




----


.. _bhenk\gitzw\model\DimensionsTrait::Methods:

Methods
+++++++


.. _bhenk\gitzw\model\DimensionsTrait::initDimensionsTrait:

DimensionsTrait::initDimensionsTrait
------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function initDimensionsTrait(
         Parameter #0 [ <required> bhenk\gitzw\model\DimensionsInterface $dimensions ]
    ): void


| :tag6:`param` :ref:`bhenk\gitzw\model\DimensionsInterface` :param:`$dimensions`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\DimensionsTrait::setDimensions:

DimensionsTrait::setDimensions
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setDimensions(
         Parameter #0 [ <optional> float $w = -1.0 ]
         Parameter #1 [ <optional> float $h = -1.0 ]
         Parameter #2 [ <optional> float $d = -1.0 ]
    ): void


| :tag6:`param` float :param:`$w`
| :tag6:`param` float :param:`$h`
| :tag6:`param` float :param:`$d`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\DimensionsTrait::setWidth:

DimensionsTrait::setWidth
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setWidth(
         Parameter #0 [ <required> float $width ]
    ): void


| :tag6:`param` float :param:`$width`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\DimensionsTrait::setHeight:

DimensionsTrait::setHeight
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setHeight(
         Parameter #0 [ <required> float $height ]
    ): void


| :tag6:`param` float :param:`$height`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\DimensionsTrait::setDepth:

DimensionsTrait::setDepth
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setDepth(
         Parameter #0 [ <required> float $depth ]
    ): void


| :tag6:`param` float :param:`$depth`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\DimensionsTrait::getDimensions:

DimensionsTrait::getDimensions
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getDimensions(
         Parameter #0 [ <optional> int $decCm = 0 ]
         Parameter #1 [ <optional> int $decIn = 1 ]
    ): string


| :tag6:`param` int :param:`$decCm`
| :tag6:`param` int :param:`$decIn`
| :tag6:`return` string


----


.. _bhenk\gitzw\model\DimensionsTrait::getWidth:

DimensionsTrait::getWidth
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getWidth(): float


| :tag6:`return` float


----


.. _bhenk\gitzw\model\DimensionsTrait::getHeight:

DimensionsTrait::getHeight
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getHeight(): float


| :tag6:`return` float


----


.. _bhenk\gitzw\model\DimensionsTrait::getDepth:

DimensionsTrait::getDepth
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getDepth(): float


| :tag6:`return` float


----

:block:`no datestamp` 
