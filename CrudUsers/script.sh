#!/bin/bash
mysql -uhomestead -psecret crudUsers < database/scripts/1_countries.sql
mysql -uhomestead -psecret crudUsers < database/scripts/2_states.sql
mysql -uhomestead -psecret crudUsers < database/scripts/3_cities.sql
