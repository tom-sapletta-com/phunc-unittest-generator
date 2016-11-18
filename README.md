# PHP Unit Test Generator (in progress, not ready...)
[![Build Status](https://travis-ci.org/tom-sapletta-com/phunc-unittest-generator.svg?branch=master)](https://travis-ci.org)
## About
With UnittestGenerator is possible create some part of file, but not all, beacue it is what must by defined by user, but i will try find some easy solution in the future, which can help with testing datatype and many methods.
+ files
+ class name
+ one method
This is version based on Phunc implementation with more classes, another version one class exist here:
https://github.com/tom-sapletta-com/unittest-generator

## Article
https://tom.sapletta.com/en/project-en/a-tool-to-automatically-generate-phpunit-tests/

## Example
```
$scaninfo = new UnittestGenerator($folder_project, $folder_test, $namespace_project, $project_author);
```

#How it works

configuration data
 + set path_source for searching php classes
 + set path_test folder for tests
 + template for unit test

find in path_source php files and get just classes:
 + no interface
 + no abstract
 + no functions

generate files for test content in path_test folder
show summary
