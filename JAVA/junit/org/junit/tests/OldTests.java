package org.junit.tests;
import junit.framework.Test;
import org.junit.runner.RunWith;
import org.junit.runners.AllTests;

@RunWith(AllTests.class)
public class OldTests {
	static public Test suite() {
		return junit.tests.AllTests.suite();
	}
}
