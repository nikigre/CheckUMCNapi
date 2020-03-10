# CheckUMCNapi
CheckUMCNapi is an API for checking Unique Master Citizen Number (Enotna matična številka občana) that was assigned to every citizen of former Yugoslav republics of the SFR Yugoslavia. More about it you can read on Wikipedia [here](https://en.wikipedia.org/wiki/Unique_Master_Citizen_Number). Slovenian instructions [here](https://nikigre.si/preveri-emso-api/).

## Prerequisites

* Programming language that supports making POST and GET requests to a remote server.

## Contributing
If you find any mistakes, have an idea to update API or anything else, open a new issue.

## How to use API?
If you want to use API, make an API request to the server with any of these links:
  * http://dev.nikigre.si/UMCN/api.php
  * https://dev.nikigre.si/UMCN/api.php
  * https://www.dev.nikigre.si/UMCN/api.php
 
 ### Variables
 To check your UMCN set variable "umcn" to UMCN you want to check. If you want to check multiple UMCN at once, put them all in variable "umcn" separated with ",".
 
 ## Examples
 
 ### Example 1
 Link: http://dev.nikigre.si/UMCN/api.php
 
 GET variables:
 * umcn=0101006505075

API answer:
```
[{
    "UMCN": "0101006505075",
    "Valid": "True",
    "PartsOfUMCN": {
        "DD": "01",
        "MM": "01",
        "YYY": "006",
        "RR": "50",
        "BBB": "507",
        "K": "5"
    },
    "Checksum": 5,
    "Gender": "F",
    "PoliticalRegion": "Slovenia",
    "DateOfBirth": "2006-1-1",
    "ErrorNumber": "",
    "Error": ""
}]
```
This example will check sent UMCN and return validation of it.

### Example 2

Link: http://dev.nikigre.si/UMCN/api.php
 
 GET variables:
 * umcn=0101006505075, 180399950524

API answer:
```
[{
    "UMCN": "0101006505075",
    "Valid": "True",
    "PartsOfUMCN": {
        "DD": "01",
        "MM": "01",
        "YYY": "006",
        "RR": "50",
        "BBB": "507",
        "K": "5"
    },
    "Checksum": 5,
    "Gender": "F",
    "PoliticalRegion": "Slovenia",
    "DateOfBirth": "2006-1-1",
    "ErrorNumber": "",
    "Error": ""
},
{
    "UMCN": "1803999705242",
    "Valid": "True",
    "PartsOfUMCN": {
        "DD": "18",
        "MM": "03",
        "YYY": "999",
        "RR": "70",
        "BBB": "524",
        "K": "2"
    },
    "Checksum": 2,
    "Gender": "F",
    "PoliticalRegion": "Serbian citizens registered abroad at a Serbian diplomatic\/consular post ",
    "DateOfBirth": "1999-3-18",
    "ErrorNumber": "",
    "Error": ""
}]
```
This example will check sent UMCNs and return JSON array.


## What each JSON parameter means
* UMCN – UMCN you have sent to API. (If you sent 12. numbers it will return 13. numbers long UMCN with checksum)
* Valid – If date and checksum are correct True, else False.
* PartsOfUMCN
  - DD – Day of birth
  - MM – Month of birth
  - YYY – Last three numbers of the year
  - RR – Number of a political region
  - BBB – Unique number
  - K – Checksum
* Checksum – Calculate the checksum
* Gender – Gender (M – male, F – female)
* PoliticalRegion – Name of country/province/city
* DateOfBirth – Date of birth in format: YYYY-MM-DD
* ErrorNumber – Error number 
  - 0 – Date of birth and checksum are invalid
  - 2 – Checksum is invalid
  - 3 – Date of birth is invalid
* Error -Description of an error

## Other errors
* Error:1 - The variable "umcn" was not set correctly.
* Error:2 - The length of UMCN must be 12 or 13 numbers.
