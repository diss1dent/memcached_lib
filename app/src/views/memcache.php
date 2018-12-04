<?php
/**
 *@var memcache Memcache
 */

echo nl2br("Connecting to memcached \n ");
print_r($connection = $memcache->connect('172.23.81.87', 11211));

if ($connection == 'Success') {
    echo nl2br("\n\n Setting memcached key:gorod value:cherkassy \n ");
    print_r($memcache->set('gorod', 'cherkassy'));

    echo nl2br("\n\n Reading memcached key:gorod \n");
    print_r($memcache->get('gorod'));

    echo nl2br("\n\n Deleting memcached key:gorod \n");
    print_r($memcache->delete('gorod'));

    echo nl2br("\n\n Reading memcached key:gorod again \n ");
    print_r($memcache->get('gorod'));

    $memcache->close();
}
