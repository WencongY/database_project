from __future__ import absolute_import
import time
import swagger_client
from swagger_client.api.activities_api import ActivitiesApi  # noqa: E501
from swagger_client.api.athletes_api import AthletesApi
from swagger_client.rest import ApiException
from pprint import pprint
import json

# Configure OAuth2 access token for authorization: strava_oauth
swagger_client.configuration.access_token = '429950742f783b0aa32e3586ed10d1fbee7f45e5'

# create an instance of the API class
#api_instance = swagger_client.ActivitiesApi()
#api_instance = swagger_client.api.athletes_api.AthletesApi()
api_instance = swagger_client.ActivitiesApi()


#different approach
with open('./dataFiles/zach_activities1.json') as f:
	activity_list = json.load(f)
f.close()
acts = {}
#write activities table
f = open ('activity.csv', 'w')
f.write("ActivityId,AthleteId,Date,ElapsedTime,MovingTime,GearId,Type")
for item in activity_list:
	f.write("%i,%i,%s,%i,%i,%s,%s\n" % (item['id'],item['athlete']['id'],item['start_date_local'],item['elapsed_time'],item['moving_time'],item['gear_id'],item['type']))
	#f.write('' + item['id'] + ',' + item['start_date_local'] + ','+ item['elapsed_time'] + ',' + item['moving_time'] + ',' + item['athlete']['id'])


with open('./dataFiles/kaley_activities1.json') as f2:
	activity_list2 = json.load(f2)
f2.close()
for item in activity_list2:
	f.write("%i,%i,%s,%i,%i,%s,%s\n" % (item['id'],item['athlete']['id'],item['start_date_local'],item['elapsed_time'],item['moving_time'],item['gear_id'],item['type']))
f.close()

