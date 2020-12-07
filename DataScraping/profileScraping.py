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
id = 4508176424 # Long | The identifier of the activity.
includeAllEfforts = True # Boolean | To include all segments efforts. (optional)

try: 
    # Get Activity
    #api_response = api_instance.getActivityById(id, includeAllEfforts=includeAllEfforts)
    api_response = api_instance.get_logged_in_athlete_activities()
    print("get_logged_in_athlete_activities: success")
    print(api_response)
    with open('zach_profile.txt', 'w') as out:
    	out.write(api_response)
except ApiException as e:
    print("Exception when calling ActivitiesApi->get_logged_in_athlete_activities: %s\n" %e)