# Description
This repository is part of a test for joining a company.

# Questions
1. Problem Solving
   - copy folder <code>problem_solving/index.php</code> to your <code>www</code> folder if you use wamp or <code>htdocs</code> folder if you use xampp.
   - then you can check the result by type <code>http://localhost/problem_solving</code> on your browser.

2. Database
   - execute query in <code>database/query.sql</code> on your database (query to create table already included).

3. Laravel
   - Prerequisite
      - Go to <b>laravel</b> folder
      - Run <code>php artisan serve</code> to run application. Open your browser, then type http://localhost:8000, press Enter.

   a. TCPDF
      - Go to <link>http://localhost:8000/pdf/sample</link> to generate sample pdf file.
      - Then go to <link>http://localhost:8000/storage/pdf/sample.pdf</link> to open file.
   b. Commerce
      - Run <code>php artisan migrate</code> to create tables
      - Run <code>php artisan db:seed</code> to insert fake data to tables
      - Ready!
