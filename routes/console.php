<?php

use App\Jobs\FetchExternalJobPosts;

Schedule::job(new FetchExternalJobPosts)->everyTwoMinutes();