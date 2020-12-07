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

#write activities table
#f = open ('kaleyActivities.csv', 'w')
#f.write("ActivityId,Date,ElapsedTime,MovingTime,AthleteId")
#for item in activity_list:
#	f.write("%i,%s,%i,%i,%i\n" % (item['id'],item['start_date_local'],item['elapsed_time'],item['moving_time'],item['athlete']['id']))
#	f.write('' + item['id'] + ',' + item['start_date_local'] + ','+ item['elapsed_time'] + ',' + item['moving_time'] + ',' + item['athlete']['id'])
#f.close()
segment_list = {}
athlete_id = activity_list[0]['athlete']['id']
f = open('activity_save.txt', 'w')
for item in activity_list:
	id = item['id']
	try:
		api_response = api_instance.get_activity_by_id(id)
		print("get_activity_by_id: success")
		print('test: %s ' % (item['type']))
		try:
			
			if (item['type'] == 'Ride') or (item['type'] == 'Run'):
				segment_efforts = api_response.segment_efforts
				print("len: %i" % len(segment_efforts))
				for segment in segment_efforts:
					segment_list[segment.segment.id] = (segment.name, segment.segment.start_latlng[0], segment.segment.start_latlng[1],segment.segment.end_latlng[0],segment.segment.end_latlng[1], segment.segment.average_grade, segment.segment.distance,id)
					print(segment.segment.id)
		except:
			print('passing on item')
				#f.write("%i,%s,%f,%f,%f,%f,%f,%f,%i,%i\n" % (segment.segment.id,segment.name, segment.segment.start_latlng[0], segment.segment.start_latlng[1],segment.segment.end_latlng[0],segment.segment.end_latlng[0], segment.segment.average_grade, segment.segment.distance,id))
			 	
	#except KeyError as e:
	
	except ApiException as e:
		print("Exception when calling ActivitiesApi->get_activity_by_id: %s\n" % e)
	


	finally:
		f.close()
		f2 = open('zach_segments1.csv', 'w') 
		f2.write("SegmentId,Name,StartLat,StartLong,EndLat,EndLong,ElapsedTime,MovingTime,ActivityId,AthleteId")
		for key, value in segment_list.items():
			f2.write("%i,%s,%f,%f,%f,%f,%f,%f,%i,%i\n" %(key, value[0], value[1], value[2],value[3],value[4], value[5], value[6], value[7],athlete_id))
		f2.close()
	#except ValueError as e:
	#	print('passing on item: %s' % e)
		





