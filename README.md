24-Istanbul-Server
==================


### Installation
----------------------------------------

* Clone repo to your localhost/server
* Put your map file
* Rename 'config/config.example.ini' to 'config/config.ini' and do necessary changes
* Have fun


### Development
----------------------------------------
[Epiphany](https://github.com/jmathai/epiphany) framework used in this project, you should check it before jump in

[PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) must followed as a coding style guideline.


### API End Points
----------------------------------------
All external end points start with `/api/`
**Response sections are not final***

-----
**Request**
`/api/poi/all.json`

Return all places of interest.

**Response**

```
{   
    pois : [
        {
            id: "4bc8088f15a7ef3b6b857ada",
            name : 'Ayasofya | Hagia Sophia',
            lat: 41.00862118012785,
            lng: 28.9799165725708,
            rating: 9.68,
            tags : ['historic', 'museum'],
            update_date: '2014-03-21'
        }
    ]
}
```

-----
**Request**
`/api/poi/{unix_date}/updated.json`

Return only poi data updated after `{unix_date}`

**Response**

Same as with `/api/poi/all.json`

-----
**Request**
`/api/question/all.json`

Return all questions.

**Response**

```
{   
    questions : [
        {
            id: 1
            question : 'Do you want to take the food with you?',
            options : [
                {
                    'text' : 'Yes'
                    'tag' : 'takeaway'
                }, {
                    'text' : 'No'
                    'tag' : 'restaurant'
                }
            ]
            update_date: '2014-03-21'
        }
    ]
}
```

-----
**Request**
`/api/question/{unix_date}/updated.json`

Return only questions updated after `{unix_date}`

**Response**

Same as with `/api/question/all.json`

-----
**Request**
`/api/map`

Return Istanbul map file

**Response**

`map/{map_file}.zip` file will be given.


### Future Work
----------------------------------------
We should add a token mechanism for security purpose
