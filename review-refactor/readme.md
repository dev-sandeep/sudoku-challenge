## code review
- Would it be safe to go into production?

  * No, There are high chances that code would run in to errors especially while dealing with calling CURL and file opertaions, 
  as there are no error handling done. 
  * In case the CURL and file operations are successful, there might be some un expected results as there are no breaks and default in switch statement.
  * CURLOPT_URL is passing the url as `string` (there are additional quotes) while the expectation of Curl function may be different.


- Does it follow best practices?

  NO, Following are my findings:
  1. No error handlings
  2. No Breaks in Switch-Case statement
  3. It is `assumed` that the user would pass only string while calling the function quote
  4. There is no point of using Class, the followed code could be written in a one single `big` function
  5. The Urls should be declared seperately and at one place, as it would be difficult to change them in future
     if they are inside code.
  6. Default providers could be written seperately
  7. It would have great if some of the generic operations would have been written in seperate function, for code re-usability


- How could we verify that it's always working as intended?

  We could write unit tests for the code, with the following tests:
  1. when a single string is passed -> we get an array with 1 element, with key being the passed string 
     eg: Input: `insuarance`, output: [`insuarance`]=>data

  2. when an array of length 1 is passed -> we get an array with 1 element, with key being the passed array's elements
     eg: Input: [`insuarance`], output: [`insuarance`]=>data

  3. when an array of length greater than 1 is passed -> we get an array with length greater than 1 element, with key being the 
     passed array's elements
     eg: Input: [`insuarance`, `bank`], output: {[`insuarance`]=>data, [`bank`]=>data}
  4. If we know a fixed `format` of response from curl_call and file_get_content, we could check the formats in response-values as well
 

 ## Refactoring

The refactored file is ![refactored php file](file-refactored.php)
