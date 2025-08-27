import os
import sys
import pathlib
from time import time
import numpy as np
import seaborn as sns
import speech_recognition as sr
from pydub import AudioSegment
import subprocess
from datetime import datetime

#Package dependency spacifig version
# Python 3.9++
# SpeechRecognition v3.8.1 | pip install SpeechRecognition==3.8.1

filenames = sys.argv[1]
filenames = "C:\\xampp\\htdocs\\vitzard-laravel\\public\\assets\\predict_data\\upload\\" + filenames #Change this path when deploy on AZURE.

preout = sys.argv[1]
preout = preout[:-4]

subprocess.call(['ffmpeg', '-i', filenames,
                   'C:\\xampp\\htdocs\\vitzard-laravel\\public\\assets\\predict_data\\'+ preout +'.wav']) #Change this path when deploy on AZURE.

output = 'C:\\xampp\\htdocs\\vitzard-laravel\\public\\assets\\predict_data\\' + preout + '.wav' #Change this path when deploy on AZURE.

r = sr.Recognizer()
r
suaranya = sr.AudioFile(output)
with suaranya as source:
    audio = r.record(source)
text = r.recognize_google(audio, language="en")
print(text)
