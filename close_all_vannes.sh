#!/bin/bash

for i in {1..30}
do
	gpio mode $i in
done
