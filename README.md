# Mubarrak (PIC Section for KUPTM Hazard System)

## To do list

Things to do: (YEAR 2022)
- :interrobang: change notification message according to new status (open/in progress/monitoring/resolved/close)
- :o: Investigation part in admin page
	- :o: Anvestigate page (remark and picture)
	- :o: managed report
	- :o: PIC department selection
	- :o: Assign PIC

- :o: PIC page
	- :o: rearrange the table according to the standard
	- :o: PIC able to make feedback

Things to do: (LAST YEAR 2021)
- :o: Update the interface.
- :o: Update the web function with the new database:
	- :o: PIC is able to register
	- :o: PIC is able to login
	- :o: PIC is able to see notification from the system if new report is added.
	- :o: PIC is able to view the report details.
		- :o: displaying multiple picture from the picture list(database).
		- :o: able to display in full resolution when click the picture.
	- :o: PIC is able to make feedback
		- :o: PIC is able to add multiple feedback picture.
	- :o: able to view full details.
	- :o: PIC able to use forgot password.

### Note:
:x: = Not implement yet.
:heavy_exclamation_mark: = Under development.
:bangbang: = Focused development.
:interrobang: = Problem.
:o: = Developed/Modified.

## Changes
log of all the changes has been made according to the date:

Date 22/03/2022
```
- Improve pic SQL query
- fixed bug on admin & pic logout
- added title to pic side panel
```

Date 21/03/2022
```
- Add admin information in investigation page
```

Date 08/03/2022
```
- improved sidebar and topbar for pic
- all table column in pic are now standard
```

Date 07/03/2022
```
- all function in investigation page are now work
- investigate, report and feedback picture show normally
```

Date 04/03/2022
```
- add assign pic in investigation mini page
- add function to the button assign pic
- fixed table column in risk level viewer page
```

Date 02/03/2022
```
- Modified admin dashboard for easier navigation
- Added mini page inside investigation page
- admin final report page added to admin index page by using print button
```

Date 01/03/2022
```
- Rearrange table column in dashboard and risk matrix and add admin final report page
- Turn edit page into investigation page
- Separate PIC assign in edit page to a new assign PIC page
```

Date 28/02/2022
```
- Review recorded meeting and take some notes
```

Date 29/08/2021
```
- pic & applicant - module combine
```

Date 27/08/2021
```
- Fixed datatable glitch.
```

Date 26/08/2021
```
- Add feature for pic to rocever password.
- Add feature for pic to edit profile information.
```

Date 07/10/2020
```
- Notification testing success but not yet implement.
```

Date 29/09/2020
```
- Notification development and testing started.
```

Date 23/09/2020
```
- Added overlay message.
- Improved interface.
```

Date 21/09/2020
```
- PIC is able to see report in full details.
- Updated the interface.
```

Date 20/09/2020
```
- PIC is able to make feedback.
- Added feature - multiple picture can be selected at the same time.
```

Date 05/09/2020
```
- Fixed PIC report viewer
```

Date 27/08/2020
```
- PIC register and login successfully update according to the new database.
```

Date 25/08/2020
```
- Enhanced the database(hazard.sql).
- Added backup file for old database(hazard_old.sql).
```

Date 23/07/2020
```
- Prototype for PIC is ready.
```

Date 11/07/2020
```
- Interface changes:
	- reportid on the most left pane side is replaced with normal number counter.
- Added htmlspecialchars function on every textbox to avoid Cross Site Script (XSS).
- Added new way to upload picture. (upload for path not image data)
- Added new type of password hash instead of using md5
```

Date 15/06/2020
```
- Developing prototype started.
- Designing database started.
```