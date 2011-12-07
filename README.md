PHOO
====
***
Brian K. Smith, [thisisbrians.com](http://thisisbrians.com/)

Phoo is a learning experience: my elementary attempt to build a truly minimal, mostly RESTful, object-oriented MVC framework in PHP. Rather than do everything, it seeks only to do what it does simply and well, but remain easily extensible for projects that outgrow it.

#To-Do
* Generalize the .htaccess file (right now it is directory dependent)
* use something besides methods to define routes. PHP limits what can be used for method names, for instance there can't be hyphens, and some reserved PHP words can't be used (such as 'new')
* Isolate framework files (that generally won't be edited by the developer) from the actual application files (which will be generated/edited by the developer)