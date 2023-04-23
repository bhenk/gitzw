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

.. _bhenk\gitzw\model\MultiLanguageTitleTrait:

MultiLanguageTitleTrait
=======================

.. table::
   :widths: auto
   :align: left

   ========== =================== 
   namespace  bhenk\\gitzw\\model 
   predicates Trait               
   ========== =================== 


.. contents::


----


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::Constants:

Constants
+++++++++


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::LANGUAGES:

MultiLanguageTitleTrait::LANGUAGES
----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   array(2) { [0]=> string(2) "nl" [1]=> string(2) "en" } 




----


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::Methods:

Methods
+++++++


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::initTitleTrait:

MultiLanguageTitleTrait::initTitleTrait
---------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function initTitleTrait(
         Parameter #0 [ <required> bhenk\gitzw\model\MultiLanguageTitleInterface $ml_title ]
    ): void


| :tag6:`param` :ref:`bhenk\gitzw\model\MultiLanguageTitleInterface` :param:`$ml_title`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::setTitleEn:

MultiLanguageTitleTrait::setTitleEn
-----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setTitleEn(
         Parameter #0 [ <required> string $title_en ]
    ): void


| :tag6:`param` string :param:`$title_en`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::setTitleNl:

MultiLanguageTitleTrait::setTitleNl
-----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setTitleNl(
         Parameter #0 [ <required> string $title_nl ]
    ): void


| :tag6:`param` string :param:`$title_nl`
| :tag6:`return` void


----


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::setPreferredLanguage:

MultiLanguageTitleTrait::setPreferredLanguage
---------------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setPreferredLanguage(
         Parameter #0 [ <required> string $preferred ]
    ): bool


| :tag6:`param` string :param:`$preferred`
| :tag6:`return` bool


----


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::getPreferredTitle:

MultiLanguageTitleTrait::getPreferredTitle
------------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getPreferredTitle(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::getPreferredLanguage:

MultiLanguageTitleTrait::getPreferredLanguage
---------------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getPreferredLanguage(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::getTitleEn:

MultiLanguageTitleTrait::getTitleEn
-----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getTitleEn(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::getTitleNl:

MultiLanguageTitleTrait::getTitleNl
-----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getTitleNl(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\model\MultiLanguageTitleTrait::getTitles:

MultiLanguageTitleTrait::getTitles
----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getTitles(): string


| :tag6:`return` string


----

:block:`no datestamp` 
