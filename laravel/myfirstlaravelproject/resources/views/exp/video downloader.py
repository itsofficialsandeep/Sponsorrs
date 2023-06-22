import requests

# Replace <BLOB_URL> with the actual blob URL
blob_url = "blob:https://www.thelallantop.com/23b6dc06-d868-496a-b9c4-4c8bc9367335"

# Send a GET request to the blob URL
response = requests.get(blob_url)

# Check the response status code
if response.status_code == 200:
    # Extract the video data from the response body
    video_data = response.content

    # Save the video data to a file
    with open("video.mp4", "wb") as f:
        f.write(video_data)

    print("Video downloaded successfully!")
else:
    print(f"Failed to download video: {response.status_code} - {response.reason}")
