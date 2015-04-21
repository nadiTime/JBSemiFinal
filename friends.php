<!-- 
1. show list of items as users
	each item show:
		a. user picture
		b. nickname
		c. register date
	-if the user got here from "find friends" link -> show all users
	-if -"- -"- -"- -"- -"- -"- "my friends" link -> show only users friends
	*make shure not to show the loged in user
2. filter menu:
	search by name:
		a. typing in the input will display the results dynamically (ajax)
		b. empty input will display all the results
		c. if there are no results show a message
	order results ASC or DESC (with radio buttons) (ajax)
		a. on selection the display will change dynamically
3. display the navigation menu
4. clicking on item (user):
	a. redirect to index.html
	b. display the selected user details and his posts
		-if the user is NOT a friend:
			secret data is hidden
			show "add friend" button
			clicking on "add friend" will disable the button and add the message "request sent to user, date"
		-if the user is not a friend BUT sent us a friend request (ajax):
			secret data is hidden 
			show "accept request" and "decline request" buttons
			clicking on accept will hide the buttons and display the user secret data
			clicking on decline will hide the buttons and show message "frienship was declined"
			-if the user that was declined enters our profile again he still see the message "request sent, date"
		-if the user is a friend:
			secret data is displayd
			unfriend option button
			