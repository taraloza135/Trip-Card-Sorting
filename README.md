# Trip Card Sorting

Solution to common trip card sorting problem in Codeigniter

Tested on ** Codeigniter 2.x and 3.x **

<pre>
	<h5>Function List</h5>
	<table>
	  <tr><td align="right"><b>1. Initialization </b></td><td align="left">$objTripSort = $this->trip_sorting->init();</td></tr>
		<tr><td align="right"><b>2. Setting Routes (Any Order) </b></td><td align="left"><ul>
				<li>$objTripSort->setTripRoutes(array("Train", "Madrid", "Barcelona", "45B", "78A", "", ""));</li>
        <li>$objTripSort->setTripRoutes(array("Airport Bus", "Barcelona", "Gerona Airport", "", "", "", ""));</li>
        <li>$objTripSort->setTripRoutes(array("Flight", "Gerona Airport", "Stockholm", "3A", "SK455", "45B", "344"));</li>
        <li>$objTripSort->setTripRoutes(array("Flight", "Stockholm", "Salamanca", "7B", "SK22", "22", "transfer"));</li>
        <li>$objTripSort->setTripRoutes(array("Flight", "Salamanca", "New York JFK", "7B", "SK22", "22", "transfer"));</li>
        <li>$objTripSort->setTripRoutes(array("Flight", "New York JFK", "Madrid", "7B", "SK22", "22", "transfer"));</li>
        </ul></td></tr>
		
		<tr>
			<td align="right">
					<b>3. Decide Start Point : </b>
			</td>
			<td align="left">$objTripSort->setTripStart('Madrid');</td>
		</tr>
		<tr>
			<td align="right">
					<b>4. Decide End Point : </b>
			</td>
			<td align="left">$objTripSort->setTripEnd('New York JFK');</td>
		</tr>
		
		<tr>
		<td align="right"><b>Output : </b></td>
		<td align="left">Take train 78A from Madrid to Barcelona. Sit in seat 45B.
Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
From Gerona Airport, take flight SK455 to Stockholm. Gate 3A, seat 45B. Baggage drop at ticket counter 344.
From Stockholm, take flight SK22 to Salamanca. Gate 7B, seat 22. Baggage will we automatically transferred from your last leg.
From Salamanca, take flight SK22 to New York JFK. Gate 7B, seat 22. Baggage will we automatically transferred from your last leg.</td>
		</tr>
		
	</table>
	
	</pre>

