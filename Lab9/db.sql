CREATE TABLE IF NOT EXISTS rooms (
  id INTEGER PRIMARY KEY AUTO_INCREMENT, 
  name TEXT, 
  capacity INTEGER,
  status VARCHAR(30));

CREATE TABLE IF NOT EXISTS reservations (
  id INTEGER PRIMARY KEY AUTO_INCREMENT, 
  name TEXT, 
  start DATETIME, 
  end DATETIME,
  room_id INTEGER,
  status VARCHAR(30),
  paid INTEGER);

INSERT INTO rooms (name, capacity, status) VALUES
('Room 1', 2, 'Dirty'),
('Room 2', 2, 'Cleanup'),
('Room 3', 3, 'Ready'),
('Room 4', 4, 'Ready'),
('Room 5', 1, 'Ready');

INSERT INTO reservations (name, start, end, room_id, status, paid) VALUES
('Mrs. Garcia', '2017-01-04', '2017-01-12', 1, 'arrived', 0),
('Mr. Jones', '2017-01-01', '2017-01-06', 2, 'checkedout', 100),
('Mr. Schwartz', '2017-01-06', '2017-01-12', 2, 'confirmed', 50),
('Mr. Gray', '2017-01-03', '2017-01-11', 3, 'expired', 0),
('Mrs. Nguyen', '2017-01-09', '2017-01-15', 5, 'new', 0);
