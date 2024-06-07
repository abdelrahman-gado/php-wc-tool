# php-wc-tool
The is a simple php script that mimic the command line `wc` tool.

## How to use:
- To output the number of bytes of a file
`php ccwc.php -c test.txt`

- To output the number of words in a file
`php ccwc.php -w test.txt`

- To output the number of lines in a file
`php ccwc.php -l test.txt`

- To output the number of characters in a file
`php ccwc.php -m test.txt`

- To get an overview of the file (no options)
`php ccwc.php test.txt`

- Also, you can make the following
`cat test.txt | php ccwc.php -l`