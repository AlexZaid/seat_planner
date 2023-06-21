from connection import get_layout_changes
import requests
import json
import re
from datetime import datetime, timedelta

def create_table_changes():
	changes=get_layout_changes()
	table="""<table ">
				<thead>
					<tr style="border:gray 2px solid;">
	    				<th colspan='3' style="background-color:#3F3FE8; color:white;">From</th>
	    				<th colspan='3' style='background-color:#00908a; color:white;'>To</th>
	    				<th colspan='2' style="background-color:#00908A; color:white;">Keys</th>
	    				<th colspan='2' style="background-color:#00908A; color:white;">Employee</th>
	  				</tr>
					<tr>
					    <th style="background-color:#3F3FE8; color:white;">Old Seat</th>
					    <th style="background-color:#3F3FE8; color:white;">Shift</th>
					    <th style="background-color:#3F3FE8; color:white;">Shared</th>	    
					   	<th style='background-color:#00908a; color:white;'>New Seat</th>
					    <th style="background-color:#00908A; color:white;">Shift</th>
					    <th style="background-color:#00908A; color:white;">Shared</th>
					    <th style="background-color:#00908A; color:white;">Current employee Keys</th>
					    <th style="background-color:#00908A; color:white;">New Keys</th>
					    <th style="background-color:#00908A; color:white;">Number ID</th>
					    <th style="background-color:#00908A; color:white;">Name</th>
					  </tr>
				</thead>
				<tbody>"""
	empid=-1
	for index, row in changes.iterrows():
		if (row["newShared"]==False and row["newShift"]==1) or (row["newShared"]==True):
			if(row["id_emp"]!=empid):
				if(row["id_emp"]!=0):
					empid=row["id_emp"]
				table+=f"""	<tr>
 			   					<td style="text-align: center;">{row["oldSeat"]}</td>
 			   					<td style="text-align: center;">{row["oldShift"]}</td>
 			   					<td style="text-align: center;">{'' if row["oldShared"]== '' else 'shared' if row["oldShared"]==1 else 'Not Shared'}</td>
 			   					<td style="text-align: center;">{row["newSeat"]}</td>
 			   					<td style="text-align: center;">{row["newShift"]}</td>
 			   					<td style="text-align: center;">{'' if row["newShared"]== '' else 'shared' if row["newShared"]==1 else 'Not Shared'}</td>
 			   					<td style="text-align: center;">{row["oldKeys"]}</td>
 			   					<td style="text-align: center;">{row["newKeys"][1] if row["id_emp"]>0 else ''}</td>
 			   					<td style="text-align: center;">{row["id_emp"] if row["id_emp"]>0 else ''}</td>
 			   					<td style="text-align: center;">{row["empName"] if row["empName"] else 'open seat'}</td>
							</tr>"""	
	
	table+="""</tbody>
		</table>"""
	
	create_message(table)

def create_message(table):
	N_DAYS_AGO = 7

	today = datetime.now().date()     
	endChanges = today - timedelta(days=1)   
	startChanges = today - timedelta(days=N_DAYS_AGO)
	
	body=f"""<p style="font-family:Fira Sans book;color: gray">Layout Management Notifications</p>
	<h1 style="font-family:Fira Sans book;color: #00afaa; display:inline;">Weekly Changes</h1>
	<h3 style="font-family:Fira Sans light;color: gray; display:inline;">({startChanges} to {endChanges})</h3><br>
	<p>Hello Team,</p>
	<p> these are the changes to be made this week</p>
	<div style="background-color: #383c45; width: 100%; height: 15px">.</div>
	<br>
	<h3 style="font-family:Fira Sans book;color: #00afaa">Changes</h3>
	{table}"""
	
	# html=re.sub('\s+',' ',body)
	send_email(body)

def send_email(html):
	url = "https://gizmo.teg.aws.in.here.com/v1/email"

	payload = json.dumps({
	  "subjectEmail": "Layout Management - Weekly Changes",
	  "fromEmail": "layoutmanagement@here.com",
	  "toEmail": "manuel.diaz@here.com,marco.a.salazar@here.com,ext-miguel.thompson@here.com,ext-paulina.mata@here.com,raquel.jimenez@here.com,fernando.delgado@here.com",
	  "plainTxt": "Go to layout tool to see the changes",
	  "html": html
	})
	headers = {
	  'Content-Type': 'application/json'
	}

	response = requests.request("POST", url, headers=headers,verify=False,data=payload)

	print(response.text)

create_table_changes()