/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package gmoney;

import org.junit.AfterClass;
import org.junit.BeforeClass;
import org.junit.Test;
import static org.junit.Assert.*;

/**
 *
 * @author user
 */
public class MoneyTest {
    
    public MoneyTest() {
    }

    @BeforeClass
    public static void setUpClass() throws Exception {
    }

    @AfterClass
    public static void tearDownClass() throws Exception {
    }

    /**
     * Test of getAmount method, of class Money.
     */
    @Test
    public void testGetAmount() {
	System.out.println("getAmount");
	.Money instance = new .Money();
	float expResult = 0.0F;
	float result = instance.getAmount();
	assertEquals(expResult, result, 0.0);
	// TODO review the generated test code and remove the default call to fail.
	fail("The test case is a prototype.");
    }

    /**
     * Test of getCurrency method, of class Money.
     */
    @Test
    public void testGetCurrency() {
	System.out.println("getCurrency");
	.Money instance = new .Money();
	String expResult = "";
	String result = instance.getCurrency();
	assertEquals(expResult, result);
	// TODO review the generated test code and remove the default call to fail.
	fail("The test case is a prototype.");
    }

    /**
     * Test of checkCurrency method, of class Money.
     */
    @Test
    public void testCheckCurrency_Money() {
	System.out.println("checkCurrency");
	.Money m = null;
	.Money instance = new .Money();
	boolean expResult = false;
	boolean result = instance.checkCurrency(m);
	assertEquals(expResult, result);
	// TODO review the generated test code and remove the default call to fail.
	fail("The test case is a prototype.");
    }

    /**
     * Test of checkCurrency method, of class Money.
     */
    @Test
    public void testCheckCurrency_String() {
	System.out.println("checkCurrency");
	String m = "";
	.Money instance = new .Money();
	boolean expResult = false;
	boolean result = instance.checkCurrency(m);
	assertEquals(expResult, result);
	// TODO review the generated test code and remove the default call to fail.
	fail("The test case is a prototype.");
    }

    /**
     * Test of changeCurrency method, of class Money.
     */
    @Test
    public void testChangeCurrency() {
	System.out.println("changeCurrency");
	String s = "";
	float rate = 0.0F;
	.Money instance = new .Money();
	instance.changeCurrency(s, rate);
	// TODO review the generated test code and remove the default call to fail.
	fail("The test case is a prototype.");
    }

    /**
     * Test of add method, of class Money.
     */
    @Test
    public void testAdd_float() {
	System.out.println("add");
	float amount = 0.0F;
	.Money instance = new .Money();
	instance.add(amount);
	// TODO review the generated test code and remove the default call to fail.
	fail("The test case is a prototype.");
    }

    /**
     * Test of sub method, of class Money.
     */
    @Test
    public void testSub_float() {
	System.out.println("sub");
	float amount = 0.0F;
	.Money instance = new .Money();
	instance.sub(amount);
	// TODO review the generated test code and remove the default call to fail.
	fail("The test case is a prototype.");
    }

    /**
     * Test of add method, of class Money.
     */
    @Test
    public void testAdd_Money() {
	System.out.println("add");
	.Money m = null;
	.Money instance = new .Money();
	instance.add(m);
	// TODO review the generated test code and remove the default call to fail.
	fail("The test case is a prototype.");
    }

    /**
     * Test of sub method, of class Money.
     */
    @Test
    public void testSub_Money() {
	System.out.println("sub");
	.Money m = null;
	.Money instance = new .Money();
	instance.sub(m);
	// TODO review the generated test code and remove the default call to fail.
	fail("The test case is a prototype.");
    }

    /**
     * Test of toString method, of class Money.
     */
    @Test
    public void testToString() {
	System.out.println("toString");
	.Money instance = new .Money();
	String expResult = "";
	String result = instance.toString();
	assertEquals(expResult, result);
	// TODO review the generated test code and remove the default call to fail.
	fail("The test case is a prototype.");
    }
}
