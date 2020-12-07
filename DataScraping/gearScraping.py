from __future__ import absolute_import
import time
import swagger_client
from swagger_client.api.activities_api import ActivitiesApi  # noqa: E501
from swagger_client.api.athletes_api import AthletesApi
from swagger_client.rest import ApiException
from pprint import pprint
import json

with open('./dataFiles/zach_profile.json') as f:
	profile = json.load(f)
f.close()

athlete_id = profile['id']
print(athlete_id)

f = open('zach_gear.csv', 'w')
f.write('GearId,Name,Miles,AthleteId\n')
for bike in profile['bikes']:
	f.write("%s,%s,%i,%i\n" % (bike['id'],bike['name'],bike['distance'], athlete_id))
for shoe in profile['shoes']:
	f.write("%s,%s,%i,%i\n" % (shoe['id'], shoe['name'], shoe['distance'], athlete_id))
f.close()