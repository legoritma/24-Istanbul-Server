24-Istanbul-Server
==================

#Warning

~~This repo automaticly deployed production server.~~

That's why you MUST test your code on your localhost or development server.

### Requirements
----------------------------------------

* An AMP Server (Apache2, MySQL, PHP)
* mod_rewrite


### Installation
----------------------------------------

* Clone repo to your localhost/server
* Put your map file
* If you don't have previous DB, import 'config/database.dump.sql'
* Rename 'config/config.example.ini' to 'config/config.ini' and do necessary changes
* Have fun


### Development
----------------------------------------

####Useful

[Epiphany](https://github.com/jmathai/epiphany) framework used in this project, you should check it before jump in

[PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) must followed as a coding style guideline.


### API End Points
----------------------------------------
All external end points start with `/api/`

### API Lists

* `/api/poi/all.json`
* `/api/poi/{unix_date}/updated.json`
* `/api/question/all.json`
* `/api/question/{unix_date}/updated.json`
* `/api/category/all.json`
* `/api/category/{unix_date}/updated.json`
* `/api/map`

-----
**Request**
`/api/poi/all.json`

Return all places of interest.

**Response**

```
{   
    count : 1,
    pois : [
        {
            id: "4bc8088f15a7ef3b6b857ada",
            name : 'Ayasofya | Hagia Sophia',
            lat: 41.008621,
            lng: 28.979917,
            tags : [24, 42], // historic and museum
            address : "Sultan Ahmet Mah. Yerebatan Cad. Sultanahmet, Fatih"
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
    count : 2,
    questions : [
        {
            id: 1,
            category : 1,
            question : 'Do you want to take the food with you?',
            options : [
                {
                    'id' : 1,
                    'text' : 'Yes',
                    'tag' : 7   // takeaway
                }, {
                    'id' : 2,
                    'text' : 'No',
                    'tag' : 6   // rastaurant
                }
            ],
            update_date: '2014-03-21'
        }, {
            id: 5,
            category : 1,
            question : 'Wanna taste some traditional foods?',
            options : [
                {
                    'id' : 4,
                    'text' : 'Yes',
                    'tag' : 4
                }, {
                    'id' : 5,
                    'text' : 'No',
                    'tag' : -1 //no tag
                }
            ],
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
`/api/category/all.json`

Return all categories.

**Response**

```
{   
    count : 1,
    category : [
        {
            id: 1,
            name : 'Eating & Drinking',
            tags : [ 4, 6, 7 ],
            update_date: '2014-03-21'
        }
    ]
}
```

-----
**Request**
`/api/category/{unix_date}/updated.json`

Return only categories updated after `{unix_date}`

**Response**

Same as with `/api/category/all.json`

-----
**Request**
`/api/map`

Return Istanbul map file

**Response**

`{map_dir}/{map_file}` will be given. For example: `map/map-current.zip`


### Future Work
----------------------------------------
We should add a token mechanism for security purpose


#### Admin Panel
We can add an admin panel for 24 Istanbul

* People who don't have a programming knowledge can administrate system
* Questions and tags can be updated without script/sql query
* Syncing with foursquare can be done automated
