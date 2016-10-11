DROP TABLE IF EXISTS speakers;
CREATE TABLE speakers (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name VARCHAR(80) NOT NULL,
  bio TEXT
);
DROP TABLE IF EXISTS talks;
CREATE TABLE talks (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title VARCHAR(255) NOT NULL,
  type VARCHAR(80) NOT NULL,
  abstract TEXT NOT NULL,
  day DATE,
  start_time TIME,
  end_time TIME,
  room VARCHAR(80)
);
DROP TABLE IF EXISTS talks_speakers;
CREATE TABLE talks_speakers (
  talk_id INTEGER NOT NULL,
  speaker_id INTEGER NOT NULL,
  FOREIGN KEY (talk_id) REFERENCES talks(id) ON DELETE CASCADE,
  FOREIGN KEY (speaker_id) REFERENCES speakers(id) ON DELETE CASCADE
);

/* Values for ZendCon 2016 */
INSERT INTO speakers
  (id, name, bio)
VALUES
  (1, 'Adam Culp','Adam Culp (\@AdamCulp), author of \"Refactoring 101\" and consultant at Rogue Wave Software, is passionate about developing with PHP and contributes to many open source projects. He organizes the SunshinePHP Developer Conference and the South Florida PHP Users Group (SoFloPHP), where he enjoys helping others write good code, implement standards, refactor efficiently, and incorporate unit and functional testing into their projects. He is a Zend Certified PHP 5.3 Engineer, is a voting member of the PHP-Fig, and holds a seat on the Zend Framework Certification Advisory Board. You can also find him on his Run Geek Radio podcast and GeekyBoy technical blog. When he is not coding or contributing to various developer communities, he can be found hiking around the United States National Parks, teaching judo, or long (ultra) distance running.'),
  (2, 'Adam Englander', 'Adam Englander is a seasoned developer with over thirty years of experience building scalable, manageable, and reliable systems. For the past ten years, he has been doing that with PHP. Adam is a vocal advocate for utilizing behavioral driven development as the driver for building great applications. His dedication to the PHP community is well known as the founder of Vegas PHP. In the past few years, Adam has been building IoT apps and has been researching ways to make this accessible in PHP.');

INSERT INTO talks
  (id, title, type, abstract, day, start_time, end_time, room)
VALUES
  (1, 'Does your code measure up?', 'session', 'After days, weeks, or months of coding, many developers don''t know how to gauge the quality of their code. Adam will introduce tools to grade, benchmark, and analyze PHP code in an automated fashion allowing developers to write better quality software. He will explain key metrics to help understand what may need to be refactored and use code smells to point out bugs before end users discover them. Attendees will see how to use these tools, know where to find them, and be able to implement them in their own workflows.', '2016-10-21', '10:30', '11:30', 'Festival 2'),
  (2, 'Refactoring legacy code', 'session', 'Faced with legacy PHP code, many decide to rewrite, thinking it will be easier, but for many reasons this can be wrong. Adam Culp will talk about the entire journey of refactoring a legacy PHP codebase. We will begin with assessment and why, cover planning how and when, discuss execution and testing, and provide step-by-step examples. Attendees will gain insights and tips on how to handle their own pile of code and refactor happy.', '2016-10-19', '17:15', '18:15', 'The Joint'),
  (3, 'BDD with Behat for beginners', 'tutorial', 'Learn the basics of behavioral driven development (BDD) with Behat to build high quality and well documented applications. You''ll learn how BDD can help you deliver greater business value more efficiently while accurately documenting the functionality of your application along the way. You''ll learn how to utilize Behat as your BDD tool. With Behat, you''ll create tests for the features in your application by utilizing a natural language syntax called Gherkin backed by PHP code to execute the steps executed in the feature''s scenarios. This will be a hands-on tutorial. You''ll learn how to implement BDD for a web application. This will include utilizing Selenium WebDriver for real world multi-browser testing including introductions to Selenium Grid and hosted integration services utilizing Selenium.', '2016-10-18', '13:00', '16:00', 'Studio 1A'),
  (4, 'Asynchronous programming in PHP', 'session', 'Asynchronous frameworks allow developers to build stateful protocol and Internet of Things applications without threading and forking. Python, Ruby, and Node.js have had asynchronous frameworks for over ten years. PHP is now starting to catch up with Icicle.io. Learn the basic concepts of event-based programming and how the event loop allows a single thread to process all the requests for an application.', '2016-10-19', '14:45', '15:45', 'The Joint');

INSERT INTO talks_speakers
  (talk_id, speaker_id)
VALUES
  (1, 1),
  (2, 1),
  (3, 2),
  (4, 2);
