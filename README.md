## Magic Almanac

##### github repository: https://github.com/noc-tur-a/BIC4MagicAlmanac

---

### Spells

#### List of Spells `/resources/views/spell/index.blade.php`
Lists all spells currently saved in database and displays: _Name, Quote, Description, Created, Updated_.  
Clicking on a spell expands the row and displays information about the kind the spell belongs to: _Name, Description, Created, Updated_.  
Spells can be edited as well as deleted.

#### Create Spell `/resources/views/spell/create.blade.php`
Adds a new entry to spells. User needs to fill in all required fields: _Name, Quote, Kind ID (a dropdown menu holds all available kinds), Description_.  
Upon successful creation of a kind, a message informing the user is displayed and the form fields emptied.  
In case of an error, an error message is displayed.

#### Edit Spell `/resources/views/spell/edit.blade.php`
Editing permits changes of: _Name, Quote, Description_ of Spells.  
Clicking `Update` saves changes to the database and forwards to `List of Spells`.  
In case of an error, an error message is displayed.

#### Search Spell `/resources/views/spell/search.blade.php`
Search for spells by name.  
Clicking on the input field "Suchtext" will open a drop down list of all spells.  
Typing into the box will display all spells where names match the typed letters.  
Selecting a spell name and clicking `Search` will display all found spells, clicking on the link forwards to `Show Spell`, with detailed information about the spell.  
`Back` forwards to `Search Spell` page.

#### Show Spell `/resources/views/spell/show.blade.php`
Displays a single selected spell with all parameters: _Name, Created, Updated, Quote, Description_.  
`Search Spell` forwards to this page.

---

### Kinds

#### List of Kinds `/resources/views/kind/index.blade.php`
Lists all kinds currently saved in database and displays: _Name, Description, Created, Updated_.  
Clicking on a kind expands the row and displays information about all spells of that kind: _Name, Quote, Description, Created, Update_.  
Kinds can be edited as well as deleted.

#### Create Kind `/resources/views/kind/create.blade.php`
Adds a new entry to spells. User needs to fill in all required fields: _Name, Description_.  
Upon successful creation of a kind, a message informing the user is displayed and the form fields emptied.  
In case of an error, an error message is displayed.

#### Edit Kind `/resources/views/kind/edit.blade.php`
Editing permits changes of: _Name, Description_ of Kinds.   
Clicking update saves changes to the database and forwards to `List of Kinds`.  
In case of an error, an error message is displayed.

#### Show Kind `/resources/views/kind/show.blade.php`
Displays a single kind will all parameters: _Name, Created, Updated, Description_.  
Can be reached by typing the kind name (slug) into the address bar (/kind/$name).

---

#### Additional Changes

##### Error Handling (Axios vs Forms.js)
We decided to use axios calls to query the database because Form.js lacks basic error handling.
Some errors aren't even catchable at all, therefore we chose to use axios, for it provides a consistence error handling routine, even
though the Controllers aren't correctly implemented (i.e. the update function in the SpellController). We fixed that.
We only use the Form.js to delete entries, be it Spells or Kinds.       
 

---

##### SpellController.php, KindController.php
We had to alter the Controllers to make certain functionality available and to make them work consistently 
for all pages (i.e. Error handling). 

The SpellSearch.vue gets all spells from the controller to make them available via the datalist element, yet the
the search finds all entries matching the input via an regular experssion match.
  
.  
 
#### Supported Browsers:
- Firefox
- Opera
- Chrome
- Microsoft Edge
