#!/usr/bin/python
import sys
import requests
from forex_python.converter import CurrencyRates

c = CurrencyRates()
eth_url = 'https://api.coinmarketcap.com/v1/ticker/ethereum/'
response_eth = requests.get(eth_url)
eth_json = response_eth.json()

credo_total = float(sys.argv[1])
total_paid = float(sys.argv[2])
credo_eth = float(sys.argv[3])

eth_price_us = float(eth_json[0]['price_usd'])
eth_price = float(c.convert('USD', 'AUD', eth_price_us)) # Change 'AUD' to any other supported currency if you wish.
credo_value_eth = float(credo_total * credo_eth)
credo_value = float(credo_value_eth * eth_price)
credo_price = (credo_eth * eth_price)

eth_print = str("$" + ("%.3f" % eth_price))
credo_print = str("$" + ("%.3f" % credo_price))
value_print = str("$" + ("%.3f" % credo_value))
difference = float(((credo_value - total_paid) / total_paid) * 100) # Percentage difference between paid and current

if difference <= 0:
    difference_print = str(("%.2f" % difference) + "% less")
elif difference > 0:
    difference_print = str(("%.2f" % difference) + "% more")

output_string = eth_print + ":" + credo_print + ":" + value_print + ":" + difference_print
print output_string