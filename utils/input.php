<?php

function x_input_filter($text) {
	return addslashes(htmlentities($text));
}