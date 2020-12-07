from __future__ import absolute_import
import time
import swagger_client
from swagger_client.api.activities_api import ActivitiesApi  # noqa: E501
from swagger_client.api.athletes_api import AthletesApi
from swagger_client.rest import ApiException
from pprint import pprint
import json
import csv

# Configure OAuth2 access token for authorization: strava_oauth
swagger_client.configuration.access_token = '429950742f783b0aa32e3586ed10d1fbee7f45e5'

# create an instance of the API class
#api_instance = swagger_client.ActivitiesApi()
#api_instance = swagger_client.api.athletes_api.AthletesApi()
api_instance = swagger_client.ActivitiesApi()


#different approach
segs = []
athActSeg = open('athlete_activity_segment.csv', 'w')
athActSeg.write('AthleteId,ActivityId,SegmentId\n')
segments = open ('segment.csv','w')
segments.write('SegmentId,Name,StartLat,StartLong,EndLat,EndLong,AverageGrade,Distance\n')
with open('./Tables/kaley_segments1.csv') as f:
	csv_read = csv.reader(f, delimiter=',')
	line_count = 0
	for row in csv_read:
		if line_count == 0:
			colNames = row;
			print(colNames)
			line_count += 1
		else:
			athActSeg.write("%s,%s,%s\n" % (row[9],row[8],row[0]))
			if (row[0] not in segs):
				segs.append(row[0])
				segments.write("%s,\'%s\',%s,%s,%s,%s,%s,%s\n" %(row[0], row[1],row[2],row[3],row[4],row[5],row[6],row[7]))
				line_count += 1
f.close()
line_count = 0
with open('./Tables/zach_segments1.csv') as f:
	csv_read = csv.reader(f, delimiter=',')
	line_count = 0
	for row in csv_read:
		if line_count == 0:
			colNames = row;
			print(colNames)
			line_count += 1
		else:
			athActSeg.write("%s,%s,%s\n" % (row[9],row[8],row[0]))
			if (row[0] not in segs):
				segs.append(row[0])
				segments.write("%s,\'%s\',%s,%s,%s,%s,%s,%s\n" %(row[0], row[1],row[2],row[3],row[4],row[5],row[6],row[7]))
				line_count += 1

f.close()

