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

.. _bhenk\gitzw\dat\RepresentationOwner:

RepresentationOwner
===================

.. table::
   :widths: auto
   :align: left

   ================ ================================================================================= 
   namespace        bhenk\\gitzw\\dat                                                                 
   predicates       Abstract                                                                          
   uses             :ref:`bhenk\gitzw\dat\RulesTrait`                                                 
   known subclasses :ref:`bhenk\gitzw\dat\ExhibitionRelations` | :ref:`bhenk\gitzw\dat\WorkRelations` 
   ================ ================================================================================= 


**Administers related Representations**


.. contents::


----


.. _bhenk\gitzw\dat\RepresentationOwner::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\RepresentationOwner::getOwnerID:

RepresentationOwner::getOwnerID
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Get the ID of the StoredObject that owns the Representations**


.. code-block:: php

   public abstract function getOwnerID(): ?string


| :tag6:`return` ?\ string  - ID of owner


----


.. _bhenk\gitzw\dat\RepresentationOwner::removeRepresentation:

RepresentationOwner::removeRepresentation
-----------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 


**Remove a Representation from this owner**


.. code-block:: php

   protected function removeRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation $representation ]
    ): bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` :param:`$representation` - Representation ID (int), Representation REPID (string) or Representation (object)
| :tag6:`return` bool  - *true* if Representation successfully removed, *false* otherwise
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationOwner::getRepresentations:

RepresentationOwner::getRepresentations
---------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Lazily fetch the related Representations**


.. code-block:: php

   public function getRepresentations(): array


| :tag6:`return` array  - owned Representations, array with Representation ID as key
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationOwner::getRepRelations:

RepresentationOwner::getRepRelations
------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Get the Join objects**


.. code-block:: php

   public abstract function getRepRelations(): array


| :tag6:`return` array  - Join> Join DataObjects, array with Representation ID as key


----


.. _bhenk\gitzw\dat\RepresentationOwner::getRepresentation:

RepresentationOwner::getRepresentation
--------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get the Representation with the given Representation ID**


.. code-block:: php

   public function getRepresentation(
         Parameter #0 [ <required> int $representationID ]
    ): ?Representation


| :tag6:`param` int :param:`$representationID` - ID of the Representation
| :tag6:`return` ?\ :ref:`bhenk\gitzw\dat\Representation`  - Representation or *null* if Representation not related
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationOwner::doAddRepr:

RepresentationOwner::doAddRepr
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 


**Actually add the Representation without checks**


.. code-block:: php

   protected function doAddRepr(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation $repr ]
    ): void


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` :param:`$repr`
| :tag6:`return` void
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationOwner::doRemoveRepr:

RepresentationOwner::doRemoveRepr
---------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 


**Actually remove the Representation without checks**


.. code-block:: php

   protected function doRemoveRepr(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation $repr ]
    ): void


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` :param:`$repr`
| :tag6:`return` void
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationOwner::getLastMessage:

RepresentationOwner::getLastMessage
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


.. _bhenk\gitzw\dat\RepresentationOwner::getMessages:

RepresentationOwner::getMessages
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


.. _bhenk\gitzw\dat\RepresentationOwner::getMessagesAsString:

RepresentationOwner::getMessagesAsString
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


.. _bhenk\gitzw\dat\RepresentationOwner::addMessage:

RepresentationOwner::addMessage
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


.. _bhenk\gitzw\dat\RepresentationOwner::resetMessages:

RepresentationOwner::resetMessages
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


.. _bhenk\gitzw\dat\RepresentationOwner::exhibitionCanAddRepresentation:

RepresentationOwner::exhibitionCanAddRepresentation
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


.. _bhenk\gitzw\dat\RepresentationOwner::workCanAddRepresentation:

RepresentationOwner::workCanAddRepresentation
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


.. _bhenk\gitzw\dat\RepresentationOwner::exhibitionCanRemoveRepresentation:

RepresentationOwner::exhibitionCanRemoveRepresentation
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


.. _bhenk\gitzw\dat\RepresentationOwner::workCanRemoveRepresentation:

RepresentationOwner::workCanRemoveRepresentation
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
