# kmtv

To get this project up and running;

1. cd into project root directory
2. run composer install to install all dependencies
3. configure your databse as indicated in the envexample file
4. you are good to go

# the api folder all the api endpoints

# on localhost;

# http://localhost/kmtv/api/videos/allvideos.php lists all videos

# http://localhost/kmtv/api/videos/newvideos.php lists all new video entries

# http://localhost/kmtv/api/videos/popularvideos.php lists all popular videos based on number of views

# http://localhost/kmtv/api/videos/search.php?search-query=value lists a all videos matching value passed

# http://localhost/kmtv/api/videos/singlevideo.php?id=value list a single video based on the value of id passed

# http://localhost/kmtv/api/videos/addlikes.php?id=value inreases the likes of a video by +1

# http://localhost/kmtv/api/category/allcategory.php lists all categories
