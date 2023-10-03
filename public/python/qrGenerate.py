import qrcode
import sys
from PIL import Image

# Define the data you want to encode in the QR code

data = sys.argv[1]
secure_type = sys.argv[2]
if(secure_type == "1") :
    Logo_link = 'python\secure_pattern_a.png'
else :
    Logo_link = 'python\secure_pattern_b.png'

logo = Image.open(Logo_link)
basewidth = 600
wpercent = (basewidth/float(logo.size[0]))
hsize = int((float(logo.size[1])*float(wpercent)))
logo = logo.resize((basewidth, hsize), Image.LANCZOS)

# Create a QR code instance
qr = qrcode.QRCode(
    version=None,  # Automatically determine the smallest version needed
    error_correction=qrcode.constants.ERROR_CORRECT_M,
    box_size=100,    # Adjust the box size as needed
    border=1        # Adjust the border size as needed
)

# Add data to the QR code
qr.add_data(data)
qr.make(fit=True)

# Create a PIL image from the QR code data
QRimg = qr.make_image(fill_color="black", back_color="white")

pos = ((QRimg.size[0] - logo.size[0]) // 2,
       (QRimg.size[1] - logo.size[1]) // 2)
QRimg.paste(logo, pos)

# Save the QR code image as a TIFF file
QRimg.save("qrcode/"+data+".tiff", format="TIFF")


print("true")
