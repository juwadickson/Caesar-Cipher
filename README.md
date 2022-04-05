# Caesar-Cipher
TITLE: Caesar Cipher Cryptography

DESCRIPTION:

Caesar Cipher is one of the simplest and most widely known encryption techniques. It is a kind of substitution cipher in which each letter in the plain-text is replaced by a letter some fixed number of positions down the alphabet. 

FEATURES:

1) Application takes Number of shift parameter from file (Details given in following parts). And according to this number new dictionary created.
2) Application support encryption and decryption methods. These methods is taken from file again (Details given in following parts). 

In encryption the text which is given as plain-text form (from file) is onverted to cipher-text according to dictionary created in first step. And this cipher-text is printed to screen. 

In decryption, encrypted text is taken by application (From file) . Then according to dictionary in reverse order it is converted back to plain-text.


APPLICATION CONSTRAINTS:

1) Input file have following structure:

[Shift Count]:[Encrypt/De-crypt]:[Alphabet 0-4]:Plain text/Cipher Text

SHIFT COUNT: Number of shift is given here as it described in first step.
SECOND FIELD: 0 -> Encrypt, 1 -> De-crypt
THIRD FIELD: Alphabet Type 0 for English, 1 for French, 2 for Spanish, 3 for Turkish
FOURTH FIELD: If second field Encrypt(0) forth part should have plain text  if  it is De-crypt(1) it should have cipher-text.

Example encrypt for english input file: 4:0:0:hello world    

Screen Output ->LIPPS ASVPH

Example for de-crypt input file 4:1:0:LIPPS ASVPH
Screen Output -> hello world

Example encrypt for Spanish input: 7:0:2:HOLLA
Screen Output -> ÑVRRH

LANGUAGE;

The application is designed using PHP and HTML

HTML is used to design the front-end of the application
PHP is used to design the backend of the program

STEPS
1. The App provides an INPUT box to get user input file
2. The App VERIFIES if input file follows the specified file input FORMAT
3. The PARAMETERS needed is EXTRACTED from the input file
4. The App then performs an ENCRYPTION/DECRYPTION operation on the text following the input file parameters
5. the Result is then displayed on the screen.
