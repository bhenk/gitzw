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

.. _bhenk\gitzw\model\PersonInterface:

PersonInterface
===============

.. table::
   :widths: auto
   :align: left

   ===================== ================================ 
   namespace             bhenk\\gitzw\\model              
   predicates            Abstract | Interface             
   known implementations :ref:`bhenk\gitzw\dao\CreatorDo` 
   ===================== ================================ 


.. contents::


----


.. _bhenk\gitzw\model\PersonInterface::Methods:

Methods
+++++++


.. _bhenk\gitzw\model\PersonInterface::getCRID:

PersonInterface::getCRID
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function getCRID(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\model\PersonInterface::setCRID:

PersonInterface::setCRID
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function setCRID(
         Parameter #0 [ <required> ?string $CRID ]
    ): void


| :tag6:`param` ?\ string :param:`$CRID`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\PersonInterface::getFirstname:

PersonInterface::getFirstname
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function getFirstname(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\model\PersonInterface::setFirstname:

PersonInterface::setFirstname
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function setFirstname(
         Parameter #0 [ <required> ?string $firstname ]
    ): void


| :tag6:`param` ?\ string :param:`$firstname`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\PersonInterface::getPrefixes:

PersonInterface::getPrefixes
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function getPrefixes(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\model\PersonInterface::setPrefixes:

PersonInterface::setPrefixes
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function setPrefixes(
         Parameter #0 [ <required> ?string $prefixes ]
    ): void


| :tag6:`param` ?\ string :param:`$prefixes`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\PersonInterface::getLastname:

PersonInterface::getLastname
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function getLastname(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\model\PersonInterface::setLastname:

PersonInterface::setLastname
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function setLastname(
         Parameter #0 [ <required> ?string $lastname ]
    ): void


| :tag6:`param` ?\ string :param:`$lastname`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\PersonInterface::getDescription:

PersonInterface::getDescription
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function getDescription(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\model\PersonInterface::setDescription:

PersonInterface::setDescription
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function setDescription(
         Parameter #0 [ <required> ?string $description ]
    ): void


| :tag6:`param` ?\ string :param:`$description`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\PersonInterface::getUrl:

PersonInterface::getUrl
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function getUrl(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\model\PersonInterface::setUrl:

PersonInterface::setUrl
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function setUrl(
         Parameter #0 [ <required> ?string $url ]
    ): void


| :tag6:`param` ?\ string :param:`$url`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\PersonInterface::getSameAs:

PersonInterface::getSameAs
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function getSameAs(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\model\PersonInterface::setSameAs:

PersonInterface::setSameAs
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


.. code-block:: php

   public abstract function setSameAs(
         Parameter #0 [ <required> ?string $sameAs ]
    ): void


| :tag6:`param` ?\ string :param:`$sameAs`
| :tag6:`return` void


----

:block:`no datestamp` 
