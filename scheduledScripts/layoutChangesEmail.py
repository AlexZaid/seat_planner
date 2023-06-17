from connection import get_layout_changes
import requests
import json

def create_table_changes():
	changes=get_layout_changes()
	table="""<table style="border:gray 2px solid;">
				<thead>
					<tr>
	    				<th colspan='3' style="border:gray 2px solid;background-color:#3F3FE8;">From</th>
	    				<th colspan='3' style="background-color:#00908A;">To</th>
	    				<th colspan='2'>Keys</th>
	    				<th colspan='2'>Employee</th>
	  				</tr>
					<tr>
					    <th style="background-color:#3F3FE8;">Old Seat</th>
					    <th style="background-color:#3F3FE8;">Shift</th>
					    <th style="background-color:#3F3FE8;">Shared</th>
					    <th style="background-color:#00908A;">New Seat</th>
					    <th style="background-color:#00908A;">Shift</th>
					    <th style="background-color:#00908A;">Shared</th>
					    <th>Current employee Keys</th>
					    <th>New Keys</th>
					    <th>Number ID</th>
					    <th>Name</th>
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
 			   					<td>{row["oldSeat"]}</td>
 			   					<td>{row["oldShift"]}</td>
 			   					<td>{'' if row["oldShared"]== '' else 'shared' if row["oldShared"]==1 else 'Not Shared'}</td>
 			   					<td>{row["newSeat"]}</td>
 			   					<td>{row["newShift"]}</td>
 			   					<td>{'' if row["newShared"]== '' else 'shared' if row["newShared"]==1 else 'Not Shared'}</td>
 			   					<td>{row["oldKeys"]}</td>
 			   					<td>{row["newKeys"][1] if row["id_emp"]>0 else ''}</td>
 			   					<td>{row["id_emp"] if row["id_emp"]>0 else ''}</td>
 			   					<td>{row["empName"] if row["empName"] else 'open seat'}</td>
							</tr>"""	
	
	table+="""</tbody>
		</table>"""
	send_email(table)

def send_email(table):
	url = "https://gizmo.teg.aws.in.here.com/v1/email"

	payload = json.dumps({
	  "subjectEmail": "Layout Changes",
	  "fromEmail": "layoutmanagement@here.com",
	  "toEmail": "manuel.diaz@here.com,manuel.diaz@here.com",
	  "plainTxt": "Go to layout tool to see the changes",
	  "html": table
	})
	headers = {
	  'Content-Type': 'application/json'
	}

	response = requests.request("POST", url, headers=headers,verify=False,data=payload)

	print(response.text)

create_table_changes()