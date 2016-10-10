#!/bin/bash

gpio mode $1 out
sleep ${2:-30}
gpio mode $1 in

